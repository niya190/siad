<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = [
        'username', 'email', 'password_hash', 'nama_lengkap', 
        'role', 'divisi', 'status', 'last_login', 'ip_address', 'avatar'
    ];
    protected $useTimestamps    = true;

    // Fungsi pencarian custom
    public function search($keyword)
    {
        return $this->groupStart()
                    ->like('nama_lengkap', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('divisi', $keyword)
                    ->groupEnd();
    }
}