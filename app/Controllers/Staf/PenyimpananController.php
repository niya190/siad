<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class PenyimpananController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Query untuk mengambil Ruangan, dan menghitung jumlah Lemari & Rak di dalamnya
        $builder = $db->table('master_ruangan');
        $builder->select('master_ruangan.id_ruangan, master_ruangan.nama_ruangan, 
                          COUNT(DISTINCT master_lemari.id_lemari) as total_lemari, 
                          COUNT(DISTINCT master_rak.id_rak) as total_rak');
        $builder->join('master_lemari', 'master_lemari.id_ruangan = master_ruangan.id_ruangan', 'left');
        $builder->join('master_rak', 'master_rak.id_lemari = master_lemari.id_lemari', 'left');
        $builder->groupBy('master_ruangan.id_ruangan');
        $ruangan = $builder->get()->getResultArray();

        $data = [
            'title'   => 'Kelola Penyimpanan',
            'ruangan' => $ruangan
        ];

        return view('staf/penyimpanan/index_view', $data);
    }
}