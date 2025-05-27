<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\RSModel;
use App\Models\FormModel;

class RulerController extends BaseController
{
    protected $formModel;
    protected $RSModel;
    protected $dompdfOptions;
    public function __construct()
    {
        $this->formModel = new FormModel();
        $this->RSModel = new RSModel();
        $this->dompdfOptions = (new Options())
            ->set('isRemoteEnabled', true)
            ->set('chroot', FCPATH)
            ->set('enable_font_subsetting', true);
    }

    private function fetchWithRs(int $id): array
    {
        $info = $this->formModel
            ->select('form_data.*, rs_list.Nama_RS AS nama_rs, rs_list.Jalan AS jalan_rs')
            ->join('rs_list', 'form_data.rs_id = rs_list.ID', 'left')
            ->where('form_data.id', $id)
            ->first();

        // If the FK was missing or invalid, fallback to dash
        if (empty($info['nama_rs'])) {
            $info['nama_rs']  = '-';
            $info['jalan_rs'] = '';
        }

        return $info;
    }

    private function getLogoDataUri(): string
    {
        $path = FCPATH . 'assets/img/Logo PTBA 750x140px.png';
        if (! file_exists($path)) {
            throw new \RuntimeException("Logo tidak ditemukan di {$path}");
        }
        $data = file_get_contents($path);
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($data);
        return 'data:' . $mime . ';base64,' . base64_encode($data);
    }

    /**
     * Render HTML ke PDF dengan Dompdf
     */
    private function renderDompdf(string $html): Dompdf
    {
        $dompdf = new Dompdf($this->dompdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf;
    }

    public function index()
    {
        // Ambil semua entri “Terverifikasi” plus data RS
        $data['list_info'] = $this->formModel
            ->select('form_data.*, rs_list.Nama_RS AS nama_rs, rs_list.Jalan AS jalan_rs')
            ->join('rs_list', 'form_data.rs_id = rs_list.ID', 'left')
            ->where('form_data.status', 'Terverifikasi')
            ->orderBy('form_data.created_at', 'DESC')
            ->findAll();


        return view('pages/ruler/list_info', $data);
    }

    public function decide($id)
    {
        $info = $this->fetchWithRs($id);
        if (session()->get('role') !== 'ruler') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $action = $this->request->getPost('action');
        if ($action === 'approve') {
            // generate QR token (misal URL unik)
            $token = bin2hex(random_bytes(16));
            $url   = base_url("ruler/sign/{$id}/{$token}");

            // simpan token ke DB (butuh kolom baru qr_token di form_data)
            $this->formModel->update($id, [
                'status'      => 'Disetujui',
                'approved_at' => date('Y-m-d H:i:s'),
                'qr_token'    => $token,
            ]);

            // RENDER DAN SIMPAN PDF
            $info = $this->fetchWithRs($id);
            $html = view('pages/admin/template_surat', [
                'info'        => $info,
                'logoDataUri' => $this->getLogoDataUri(),
            ]);
            $dompdf  = $this->renderDompdf($html);
            $pdfData = $dompdf->output();
            $filePath = WRITEPATH . "uploads/surat_{$id}.pdf";
            file_put_contents($filePath, $pdfData);

            $email = \Config\Services::email();
            $email->setTo($info['email']);
            $email->setSubject("Permintaan #{$info['id']} Anda Telah Disetujui!");
            $email->setMessage("
                Hai {$info['nama_lengkap']},<br><br>
                Permintaan surat perobatan Anda (ID: {$info['id']}, Nama Keluarga: {$info['nama_keluarga']}, RS: {$info['nama_rs']})<br>
                telah <b>Disetujui</b> oleh Pimpinan.<br><br> Anda dapat mengunduh surat PDF melalui tautan di aplikasi. Salam,<br>Sistem Surat Perobatan PTBA
            ");
            $email->send();

            return redirect()->to('/list-info')
                ->with('message', 'Data Disetujui!.');
        } else {
            $this->formModel->update($id, [
                'status'      => 'Ditolak',
                'approved_at' => date('Y-m-d H:i:s'),
            ]);
            $email = \Config\Services::email();
            $email->setTo($info['email']);
            $email->setSubject("Mohon Maaf, Permintaan #{$info['id']} Anda Telah Ditolak!");
            $email->setMessage("
                Hai {$info['nama_lengkap']},<br><br>
                Permintaan surat perobatan Anda (ID: {$info['id']}, Nama Keluarga: {$info['nama_keluarga']}, RS: {$info['nama_rs']})<br>
                telah <b>Ditolak</b> oleh Pimpinan.<br><br>. Salam,<br>Sistem Surat Perobatan PTBA
            ");
            $email->send();
            return redirect()->to('/list-info')
                ->with('message', 'Data ditolak!.');
        }
    }
    public function sign($id, $token)
    {
        // update status
        $this->formModel->update($id, [
            'status'    => 'Tertandatangan',
            'signed_at' => date('Y-m-d H:i:s'),
        ]);

        // LOKASI FILE PDF YANG SUDAH DIBUAT SAAT VERIFIKASI
        $filePath = WRITEPATH . "uploads/surat_{$id}.pdf";
        if (! file_exists($filePath)) {
            throw new \RuntimeException("File PDF untuk ID {$id} tidak ditemukan.");
        }

        // Kirim email dengan lampiran PDF yang sudah ada
        $info = $this->fetchWithRs($id);
        $email = \Config\Services::email();
        $email->setTo($info['email']);
        $email->setSubject("Surat Anda (#{$id}) Telah Ditandatangani");
        $email->setMessage("
            Hai {$info['nama_lengkap']},<br><br>
            Surat perobatan Anda telah <b>ditandatangani</b>.<br>
            Silakan unduh lampiran PDF tersemat.<br><br>
            Salam,<br>Sistem Surat Perobatan PTBA
        ");
        $email->attach(WRITEPATH . "uploads/surat_{$id}.pdf");
        $email->send();

        return redirect()->to('/list-info')
            ->with('message', 'Surat berhasil ditandatangani!');
    }
}
