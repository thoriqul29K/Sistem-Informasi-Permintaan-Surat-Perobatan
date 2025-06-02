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

    public function markAllRead()
    {
        if (! session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session('user_id');
        // Update semua notifikasi milik user utk is_read = 1
        $this->notifModel
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->set(['is_read' => 1, 'updated_at' => date('Y-m-d H:i:s')])
            ->update();

        return redirect()->to('/notifications')->with('message', 'Semua notifikasi telah ditandai terbaca.');
    }

    public function delete($id)
    {
        if (! session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session('user_id');
        $notif = $this->notifModel->find($id);
        if (! $notif || $notif['user_id'] != $userId) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        $this->notifModel->delete($id);
        return redirect()->to('/notifications')->with('message', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Hapus semua notifikasi user
     */
    public function deleteAll()
    {
        if (! session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = session('user_id');
        // Hapus semua notifikasi milik user
        $this->notifModel
            ->where('user_id', $userId)
            ->delete();

        return redirect()->to('/notifications')->with('message', 'Semua notifikasi telah dihapus.');
    }
}
