<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'type',
        'data',
        'is_read',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    /**
     * Mengambil notifikasi belum terbaca untuk user tertentu
     */
    public function getUnreadByUser(int $userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Menghitung jumlah notifikasi belum terbaca
     */
    public function countUnread(int $userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_read', 0)
            ->countAllResults();
    }

    /**
     * Tandai semua notifikasi user sebagai terbaca
     */
    public function markAllRead(int $userId)
    {
        return $this->where('user_id', $userId)
            ->set(['is_read' => 1, 'updated_at' => date('Y-m-d H:i:s')])
            ->update();
    }
}
