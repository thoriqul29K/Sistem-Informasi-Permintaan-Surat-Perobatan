<?php

namespace App\Controllers;

use App\Models\FormModel;
use CodeIgniter\Controller;

class FormController extends BaseController
{
    public function SIPSP(): string
    {
        return view('pages/form_permintaansurat');
    }

    public function simpan()
    {
        $formModel = new FormModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'nik'          => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'keterangan'   => $this->request->getPost('keterangan'),
            'status'       => 'Menunggu' // Default status
        ];

        $formModel->insert($data);
        return redirect()->to('/form-permintaan-surat');
    }
}
