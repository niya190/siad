<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_mata_kuliah' => 'INF11017',
                'nama_mata_kuliah' => 'Pemrograman Web',
                'sks'              => 4,
            ],
            [
                'kode_mata_kuliah' => 'INF11018',
                'nama_mata_kuliah' => 'Data Mining',
                'sks'              => 3,
            ],
            [
                'kode_mata_kuliah' => 'INF11019',
                'nama_mata_kuliah' => 'Metode Numerik',
                'sks'              => 3,
            ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('mata_kuliah')->insertBatch($data);
    }
}