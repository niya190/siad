<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        // Menyiapkan data dosen
        $data = [
            [
                'nidn' => '0025038904',
                'nama' => 'Muhamad Radzi Rathomi S.Kom, M.Cs',
            ],
            // Anda bisa tambahkan dosen lain di sini jika perlu
            // [
            //     'nidn' => '0012345678',
            //     'nama' => 'Dosen Dummy Lain, S.T, M.T',
            // ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('dosen')->insertBatch($data);
    }
}