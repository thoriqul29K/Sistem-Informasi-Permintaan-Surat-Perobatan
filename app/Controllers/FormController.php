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

        $data = array_map('trim', $this->request->getPost());
        $data['rs_id'] = $data['rumah_sakit_dituju'];
        unset($data['rumah_sakit_dituju']);
        $data['email'] = session()->get('email');
        $data['status'] = 'Menunggu';

        $this->formModel->insert($data);

        // Simpan pesan sukses ke flashdata
        return redirect()->back()->with('success', 'Informasi berhasil dikirim.');
    }
}
