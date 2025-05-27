<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\RSModel;
use App\Models\FormModel;

class RulerController extends BaseController
{
    protected $formModel;
    protected $RSModel;
    public function __construct()
    {
        $this->formModel = new FormModel();
        $this->RSModel = new RSModel();
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
        $info = $this->fetchWithRs($id);
        $filePath = WRITEPATH . "uploads/surat_{$id}.pdf";
        $info = $this->formModel->find($id);
        if (! $info || $info['qr_token'] !== $token) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // update status jadi Tertandatangan
        $this->formModel->update($id, ['status' => 'Tertandatangan', 'signed_at' => date('Y-m-d H:i:s')]);

        // Kirim PDF via email
        $email = \Config\Services::email();
        $email->setTo($info['email']);
        $email->setSubject("Surat Anda (#{$info['id']}) Telah Ditandatangani");
        $email->setMessage("
        Hai {$info['nama_lengkap']},<br><br>
        Surat perobatan Anda telah <b>ditandatangani</b>.<br>
        Silakan unduh lampiran PDF berikut.
    ");
        $email->attach($filePath, 'attachment', "surat_{$id}.pdf", 'application/pdf');
        $email->send();

        return redirect()->to('/list-info')
            ->with('message', 'Data berhasil di tanda tangan!.');
    }
}
