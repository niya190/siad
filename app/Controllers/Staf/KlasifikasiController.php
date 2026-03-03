<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class KlasifikasiController extends BaseController
{
    public function populer()
    {
        $db = \Config\Database::connect();
        
        // Query untuk menghitung jumlah arsip per klasifikasi
        $builder = $db->table('master_klasifikasi');
        $builder->select('master_klasifikasi.kode_klasifikasi, master_klasifikasi.nama_klasifikasi, COUNT(data_arsip.id_arsip) as total_akses');
        // Join ke data_arsip untuk dihitung
        $builder->join('data_arsip', 'data_arsip.id_klasifikasi = master_klasifikasi.id_klasifikasi', 'left');
        $builder->groupBy('master_klasifikasi.id_klasifikasi');
        $builder->orderBy('total_akses', 'DESC');
        $builder->limit(5); // Ambil 5 Teratas
        
        $klasifikasi = $builder->get()->getResultArray();

        $data = [
            'title'       => 'Klasifikasi Sering Diakses',
            'klasifikasi' => $klasifikasi
        ];

        return view('staf/klasifikasi/populer_view', $data);
    }
}