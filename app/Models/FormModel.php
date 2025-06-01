<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table         = 'form_data';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'nama_keluarga',
        'np',
        'email',
        'umur',
        'jenis_kelamin',
        'jenjang_jabatan',
        'rs_id',
        'status',
        'verified_at',
        'approved_at',
        'created_at',
        'qr_token',
        'signed_at',
        'created_by'
    ];

    // Opsional: helper untuk status
    public const STATUS_TERTANDA = 'Tertandatangan';
}
