<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table = 'form_data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'nama_keluarga',
        'np',
        'umur',
        'jenis_kelamin',
        'jenjang_jabatan',
        'rumah_sakit_dituju',
        'status'
    ];
}
