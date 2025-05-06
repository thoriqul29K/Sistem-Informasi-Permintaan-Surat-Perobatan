<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table      = 'form_data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'umur',
        'jenis_kelamin',
        'nama_keluarga',
        'np',
        'jenjang_jabatan',
        'rs_id',
        'status',
        'created_at',
        'approved_at'
    ];
}
