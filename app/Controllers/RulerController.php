<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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

            return redirect()->to('/list-info')
                ->with('message', 'Data Disetujui!.');
        } else {
            $this->formModel->update($id, [
                'status'      => 'Ditolak',
                'approved_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to('/list-info')
                ->with('message', 'Data ditolak!.');
        }
    }

    public function sign($id, $token)
    {
        $info = $this->formModel->find($id);
        if (! $info || $info['qr_token'] !== $token) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // update status jadi Tertandatangan
        $this->formModel->update($id, ['status' => 'Tertandatangan', 'signed_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/list-info')
            ->with('message', 'Data berhasil di tanda tangan!.');
    }
}
