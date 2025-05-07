<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RSModel;
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
        $rules = [
            'nama_lengkap'    => 'required|max_length[70]',
            'nama_keluarga'   => 'required|max_length[70]',
            'np'              => 'required|integer',
            'umur'            => 'required|integer',
            'jenis_kelamin'   => 'required|in_list[Laki-laki,Perempuan]',
            'jenjang_jabatan' => 'required|max_length[70]',
            'rumah_sakit_dituju' => 'required|integer'
        ];

        if (! $this->validate($rules)) {
            // Simpan pesan kesalahan ke flashdata
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = array_map('trim', $this->request->getPost());
        $data['rs_id'] = $data['rumah_sakit_dituju'];
        unset($data['rumah_sakit_dituju']);

        $this->formModel->insert($data);

        // Simpan pesan sukses ke flashdata
        return redirect()->back()->with('success', 'Informasi berhasil dikirim.');
    }
}
