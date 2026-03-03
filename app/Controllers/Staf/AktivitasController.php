<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class AktivitasController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Mengambil 50 data arsip terakhir yang diubah/dibuat beserta nama petugasnya
        $builder = $db->table('data_arsip');
        $builder->select('data_arsip.id_arsip, data_arsip.nomor_surat, data_arsip.created_at, data_arsip.updated_at, users.nama_lengkap');
        $builder->join('users', 'users.id_user = data_arsip.id_petugas', 'left');
        $builder->orderBy('data_arsip.updated_at', 'DESC');
        $builder->limit(50);
        
        $aktivitas = $builder->get()->getResultArray();

        $data = [
            'title'     => 'Aktivitas Terbaru',
            'aktivitas' => $aktivitas
        ];

        return view('staf/aktivitas/index_view', $data);
    }
}