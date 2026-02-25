<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $arsipModel = new ArsipModel();

        // Ambil tanggal hari ini
        $hari_ini = date('Y-m-d');

        // Hitung statistik untuk ditampilkan di view
        $data = [
            'title'          => 'Dashboard Staf',
            'surat_masuk'    => $arsipModel->where('jenis_arsip', 'Surat Masuk')->countAllResults(),
            'surat_keluar'   => $arsipModel->where('jenis_arsip', 'Surat Keluar')->countAllResults(),
            'total_arsip'    => $arsipModel->countAllResults(),
            'arsip_hari_ini' => $arsipModel->where('tanggal_terima', $hari_ini)->countAllResults()
        ];

        return view('staf/dashboard_view', $data);
    }
}