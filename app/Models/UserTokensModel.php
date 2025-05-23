<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokensModel extends Model
{
    protected $table      = 'user_tokens';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'token',
        'expires_at',
        'created_at'
    ];
    protected $useTimestamps = false; // Karena kita secara manual mengisi created_at
}
