<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RencanaStudiSeeder extends Seeder
{
    public function run()
    {
        // 1. NIM Mahasiswa sudah kita ketahui
        $nim_mahasiswa = '2301020070';

        // 2. Ambil ID Mata Kuliah "Pemrograman Web" (INF11017)
        $matkul_web = $this->db->table('mata_kuliah')
                              ->where('kode_mata_kuliah', 'INF11017')
                              ->get()->getRow();
        
        // 3. Ambil ID Jadwal untuk "Pemrograman Web"
        $jadwal_web = $this->db->table('jadwal')
                              ->where('id_mata_kuliah', $matkul_web->id_mata_kuliah)
                              ->get()->getRow();

        // 4. Ambil ID Mata Kuliah "Data Mining" (INF11018)
        $matkul_dm = $this->db->table('mata_kuliah')
                             ->where('kode_mata_kuliah', 'INF11018')
                             ->get()->getRow();

        // 5. Ambil ID Jadwal untuk "Data Mining"
        $jadwal_dm = $this->db->table('jadwal')
                             ->where('id_mata_kuliah', $matkul_dm->id_mata_kuliah)
                             ->get()->getRow();


        // Menyiapkan data Rencana Studi
        $data = [
            // Mahasiswa Rifqy mengambil Pemrograman Web
            [
                'nim'         => $nim_mahasiswa,
                'id_jadwal'   => $jadwal_web->id_jadwal,
                'nilai_angka' => null, // Belum ada nilai
                'nilai_huruf' => null, // Belum ada nilai
            ],
            // Mahasiswa Rifqy mengambil Data Mining
            [
                'nim'         => $nim_mahasiswa,
                'id_jadwal'   => $jadwal_dm->id_jadwal,
                'nilai_angka' => null, // Belum ada nilai
                'nilai_huruf' => null, // Belum ada nilai
            ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('rencana_studi')->insertBatch($data);
    }
}