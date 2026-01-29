<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel; // Panggil Model Arsip

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        // Hitung Data Real-time
        $data = [
            'title' => 'Dashboard Arsip',
            'total_arsip'   => $model->countAllResults(),
            'surat_masuk'   => $model->where('jenis_arsip', 'Surat Masuk')->countAllResults(),
            'surat_keluar'  => $model->where('jenis_arsip', 'Surat Keluar')->countAllResults(),
            'sk'            => $model->where('jenis_arsip', 'SK (Surat Keputusan)')->countAllResults(),
            'berkas_proyek' => $model->where('jenis_arsip', 'Berkas Proyek')->countAllResults(),
            
            // Ambil 5 Arsip Terbaru untuk ditampilkan di tabel mini
            'terbaru'       => $model->orderBy('created_at', 'DESC')->findAll(5)
        ];

        return view('staf/dashboard_view', $data);
    }
}