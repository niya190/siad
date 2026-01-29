<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Menyiapkan data mahasiswa
        $data = [
            [
                'nim'  => '2301020070',
                'nama' => 'Rifqy Athaya Prayuda',
            ],
            // Anda bisa tambahkan mahasiswa lain di sini jika perlu
            // [
            //     'nim'  => '2301020001',
            //     'nama' => 'Mahasiswa Dummy Lain',
            // ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('mahasiswa')->insertBatch($data);
    }
}