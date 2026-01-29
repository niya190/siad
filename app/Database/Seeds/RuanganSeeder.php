<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_ruangan' => 'Ruang 07 FTTK',
            ],
            [
                'nama_ruangan' => 'Ruang 08 FTTK',
            ],
            [
                'nama_ruangan' => 'Lab Komputer FTTK',
            ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('ruangan')->insertBatch($data);
    }
}