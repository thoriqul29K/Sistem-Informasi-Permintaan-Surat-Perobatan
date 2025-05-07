<?php

namespace App\Models;

use CodeIgniter\Model;

class RSModel extends Model
{
    protected $table = 'rs_list';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID',
        'Nama_RS',
        'Jalan'
    ];
}
