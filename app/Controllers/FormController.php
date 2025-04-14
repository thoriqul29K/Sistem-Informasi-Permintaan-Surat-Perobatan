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
            'nama_lengkap'       => $this->request->getPost('nama_lengkap'),
            'umur'               => $this->request->getPost('umur'),
            'jenis_kelamin'      => $this->request->getPost('jenis_kelamin'),
            'nama_keluarga'      => $this->request->getPost('nama_keluarga'),
            'np'                 => $this->request->getPost('np'),
            'jenjang_jabatan'    => $this->request->getPost('jenjang_jabatan'),
            'rumah_sakit_dituju' => $this->request->getPost('rumah_sakit_dituju'),
            'status'             => 'Menunggu'
        ];
        $formModel->insert($data);


        return redirect()->to('/form-permintaan-surat');
    }
}
