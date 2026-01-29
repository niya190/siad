<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user'; // Pastikan ini sesuai (id_user atau id)
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // INI YANG PENTING: Daftarkan semua kolom baru
    protected $allowedFields    = [
        'kode_peran', 
        'nama_user', 
        'password_hash', 
        'role', 
        'kode_bagian', 
        'created_at', 
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
}