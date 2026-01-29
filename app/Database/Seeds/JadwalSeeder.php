<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        // 1. Ambil ID Mata Kuliah "Pemrograman Web"
        $matkul_web = $this->db->table('mata_kuliah')
                              ->where('kode_mata_kuliah', 'INF11017')
                              ->get()->getRow();

        // 2. Ambil ID Mata Kuliah "Data Mining"
        $matkul_datamining = $this->db->table('mata_kuliah')
                                     ->where('kode_mata_kuliah', 'INF11018')
                                     ->get()->getRow();

        // 3. Ambil ID Ruangan "Ruang 07 FTTK"
        $ruangan_07 = $this->db->table('ruangan')
                               ->where('nama_ruangan', 'Ruang 07 FTTK')
                               ->get()->getRow();
        
        // 4. Ambil ID Ruangan "Lab Komputer FTTK"
        $ruangan_lab = $this->db->table('ruangan')
                                ->where('nama_ruangan', 'Lab Komputer FTTK')
                                ->get()->getRow();

        // 5. NIDN Dosen sudah kita ketahui
        $nidn_dosen = '0025038904';

        // Menyiapkan data jadwal
        $data = [
            // Jadwal 1: Pemrograman Web
            [
                'nama_kelas'     => 'A',
                'id_mata_kuliah' => $matkul_web->id_mata_kuliah, // ID dari query
                'id_ruangan'     => $ruangan_07->id_ruangan, // ID dari query
                'nidn'           => $nidn_dosen,
                'hari'           => 'Senin',
                'jam'            => '08:00 - 10:30',
            ],
            // Jadwal 2: Data Mining (oleh dosen yang sama)
            [
                'nama_kelas'     => 'A',
                'id_mata_kuliah' => $matkul_datamining->id_mata_kuliah, // ID dari query
                'id_ruangan'     => $ruangan_lab->id_ruangan, // ID dari query
                'nidn'           => $nidn_dosen,
                'hari'           => 'Rabu',
                'jam'            => '10:30 - 13:00',
            ],
        ];

        // Menggunakan Query Builder untuk insert data
        $this->db->table('jadwal')->insertBatch($data);
    }
}