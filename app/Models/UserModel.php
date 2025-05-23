<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'role'];

    public function saveRememberToken($userId, $token, $expiresAt)
    {
        // Simpan ke tabel user_tokens
        $this->db->table('user_tokens')->insert([
            'user_id'    => $userId,
            'token'      => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public function validateRememberToken($userId, $token)
    {
        $row = $this->db->table('user_tokens')
            ->where('user_id', $userId)
            ->where('token', $token)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->get()
            ->getRowArray();
        return (bool) $row;
    }
}
