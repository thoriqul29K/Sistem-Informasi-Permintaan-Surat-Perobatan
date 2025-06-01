<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RSModel;
use App\Models\UserModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class FormController extends BaseController
{

    /** @var FormModel */
    protected $formModel;

    public function __construct()
    {
        $this->formModel = new FormModel();
    }

    public function SIPSP(): string
    {
        // Ambil semua record RS dari database
        $rsModel = new RSModel();
        $data['rs_list'] = $rsModel->findAll();

        // Kirim ke view
        return view('pages/form_permintaansurat', $data);
    }

    public function simpan()
    {

        $data = array_map('trim', $this->request->getPost());
        $data['rs_id'] = $data['rumah_sakit_dituju'];
        unset($data['rumah_sakit_dituju']);
        $data['email'] = session()->get('email');
        $data['status'] = 'Menunggu';
        $data['created_by'] = session()->get('user_id');
        $userEmail = session('email'); // misal user pemilik, untuk info lebih lanjut
        $userIdPemohon = session('user_id');

        // 1) Simpan form
        $this->formModel->insert($data);
        $formId = $this->formModel->getInsertID();

        // 2) Dapatkan daftar admin
        $adminModel = new UserModel();
        $admins = $adminModel->where('role', 'admin')->findAll();

        $notifModel = new NotificationModel();
        foreach ($admins as $admin) {
            $notifData = [
                'user_id'    => $admin['id'],
                'type'       => 'form_submitted',
                'data'       => json_encode([
                    'form_id'       => $formId,
                    'pemohon_id'    => $userIdPemohon,
                    'nama_lengkap'  => $data['nama_lengkap'],
                    'nama_keluarga' => $data['nama_keluarga'],
                    'rs_id'         => $data['rs_id']
                ]),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $notifModel->insert($notifData);
        }

        // Simpan pesan sukses ke flashdata
        return redirect()->back()->with('success', 'Informasi berhasil dikirim.');
    }
}
