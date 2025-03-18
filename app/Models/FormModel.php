<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table      = 'form_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_lengkap', 'email', 'phone', 'nik', 'alamat', 'keterangan', 'status'];
}
