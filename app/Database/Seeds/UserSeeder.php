<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Password default untuk semua user
        $password = password_hash('123456', PASSWORD_DEFAULT);

        $data = [
            // 1. Akun Admin
            [
                'nama_user'     => 'admin', // Username untuk login
                'password_hash' => $password,
                'role'          => 'admin',
                'kode_peran'    => null, // Admin tidak terikat NIM/NIDN
            ],
            // 2. Akun Mahasiswa (Rifqy)
            [
                'nama_user'     => '2301020070', // Username = NIM
                'password_hash' => $password,
                'role'          => 'mahasiswa',
                'kode_peran'    => '2301020070', // Terikat ke NIM Anda
            ],
            // 3. Akun Dosen (Muhamad Radzi)
            [
                'nama_user'     => '0025038904', // Username = NIDN
                'password_hash' => $password,
                'role'          => 'dosen',
                'kode_peran'    => '0025038904', // Terikat ke NIDN Dosen
            ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('user')->insertBatch($data);
    }
}