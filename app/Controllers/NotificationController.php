<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    protected $notifModel;

    public function __construct()
    {
        $this->notifModel = new NotificationModel();
    }

    /**
     * Halaman daftar semua notifikasi user
     */
    public function index()
    {
        if (! session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $userId = session('user_id');
        $data['notifications'] = $this->notifModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
        return view('pages/notifications_all', $data);
    }

    /**
     * Tandai satu notifikasi sebagai read
     */
    public function markRead($id)
    {
        if (! session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Pastikan notifikasi milik user
        $notif = $this->notifModel->find($id);
        if (!$notif || $notif['user_id'] != session('user_id')) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $this->notifModel->update($id, [
            'is_read'    => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Setelah mark read, redirect kembali ke halaman notifikasi
        return redirect()->to('/notifications')->with('message', 'Notifikasi telah dibaca.');
    }
}
