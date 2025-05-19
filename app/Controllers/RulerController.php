<?php

namespace App\Controllers;

use App\Models\FormModel;

class RulerController extends BaseController
{
    protected $formModel;

    public function __construct()
    {
        $this->formModel = new FormModel();
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
        // Pastikan hanya ruler yang bisa
        if (session()->get('role') !== 'ruler') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $action = $this->request->getPost('action');
        if ($action === 'approve') {
            $this->formModel->update($id, ['status' => 'Disetujui']);
            return redirect()->to('/list-info')
                ->with('message', 'Informasi disetujui, dan surat dicetak!.');
        } else {
            $this->formModel->update($id, ['status' => 'Ditolak']);
            return redirect()->to('/list-info')
                ->with('message', 'Informasi ditolak!');
        }
    }
}
