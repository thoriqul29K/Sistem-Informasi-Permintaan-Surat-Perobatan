<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RSModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use CodeIgniter\Exceptions\PageNotFoundException;

class AdminController extends BaseController
{
    protected $formModel;
    protected $rsModel;
    protected $logoDataUri;



    public function __construct()
    {
        $this->formModel = new FormModel();
        $this->rsModel   = new RSModel();

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

        if (! $info) {
            throw PageNotFoundException::forPageNotFound("Data dengan ID {$id} tidak ditemukan.");
        }

        // If the FK was missing or invalid, fallback to dash
        if (empty($info['nama_rs'])) {
            $info['nama_rs']  = '-';
            $info['jalan_rs'] = '';
        }

        return $info;
    }


    private function buildLogoDataUri(): string
    {
        $path = FCPATH . 'assets/img/Logo PTBA 750x140px.png';
        if (! file_exists($path)) {
            throw new \RuntimeException("Logo tidak ditemukan");
        }
        $data = file_get_contents($path);
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($data);
        return 'data:' . $mime . ';base64,' . base64_encode($data);
    }

    public function index()
    {
        $role = session()->get('role');
        // 1) Ambil data form_data + join sekali ke rs_list
        $builder = $this->formModel
            ->select(
                'form_data.id, '
                    . 'form_data.nama_lengkap, '
                    . 'form_data.nama_keluarga, '
                    . 'form_data.np, '
                    . 'form_data.umur, '
                    . 'form_data.jenjang_jabatan, '
                    . 'rs_list.Nama_RS AS nama_rs, '
                    . 'rs_list.Jalan AS jalan_rs, '
                    . 'form_data.status'
            )
            ->join('rs_list', 'form_data.rs_id = rs_list.ID', 'left')
            ->orderBy('form_data.created_at', 'DESC');
        if ($role === 'admin') {
            // admin lihat Menunggu, Disetujui, Ditolak
            $builder->whereIn('form_data.status', ['Menunggu', 'Disetujui', 'Ditolak', 'Tertandatangan']);
        } else if ($role === 'ruler') {
            // ruler hanya lihat Terverifikasi & Disetujui
            $builder->whereIn('form_data.status', ['Terverifikasi', 'Disetujui', 'Tertandatangan']);
        } else {
            // misal user biasa, dialihkan
            return redirect()->to('/')->with('error', 'Akses ditolak.');
        }
        $data['list_info'] = $builder->findAll();

        return view('pages/admin/list_info', $data);
    }



    public function detail($id)
    {
        $info = $this->fetchWithRs($id);
        return view('pages/admin/detail_info', ['info' => $info]);
    }
    public function verify($id)
    {
        // Hanya admin yang boleh
        if (session()->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $info = $this->fetchWithRs($id);

        // 2) Update status dan timestamps
        $this->formModel->update($id, [
            'status'       => 'Terverifikasi',
            #'verified_by'  => session()->get('user_id'),
            'verified_at'  => date('Y-m-d H:i:s'),
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

        // 3) Kirim notificasi email ke user
        $emailService = \Config\Services::email();
        $emailService->setTo($info['email']);
        $emailService->setSubject("Permintaan Surat Anda (#{$id}) Telah Diverifikasi");
        $emailService->setMessage("
            Hai {$info['nama_lengkap']},<br><br>
            Permintaan surat perobatan Anda:<br>
            &mdash; <b>ID</b>: {$id}<br>
            &mdash; <b>Nama Keluarga</b>: {$info['nama_keluarga']}<br>
            &mdash; <b>Rumah Sakit</b>: {$info['nama_rs']}<br><br>
            telah <b>diverifikasi</b> oleh Admin TU.<br><br>
            Silakan tunggu proses selanjutnya di sistem kami.<br><br>
            Salam,<br>
            <i>Sistem Surat Perobatan PTBA</i>
        ");
        $emailService->send();

        return redirect()->to('/list-info')
            ->with('message', 'Data terverifikasi!');
    }



    public function generatePdf($id)
    {
        // Save PDF on disk and trigger download
        $info    = $this->fetchWithRs($id);
        $html    = view('pages/admin/template_surat', [
            'info'        => $info,
            'logoDataUri' => $this->getLogoDataUri(),
        ]);
        $dompdf  = $this->renderDompdf($html);
        $pdfData = $dompdf->output();

        $filePath = WRITEPATH . "uploads/surat_{$id}.pdf";
        file_put_contents($filePath, $pdfData);

        return $this->response->download($filePath, null);
    }

    public function hapus($id)
    {
        // Cari data berdasarkan ID
        $info = $this->formModel->find($id);
        if (!$info) {
            return redirect()->to('/list-info')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data
        $this->formModel->delete($id);
        return redirect()->to('/list-info')->with('message', 'Data berhasil dihapus.');
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

    private function renderDompdf(string $html): Dompdf
    {
        $dompdf = new Dompdf($this->dompdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf;
    }
}
