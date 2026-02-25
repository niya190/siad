<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $arsipModel = new ArsipModel();

        // 1. Ambil data statistik berdasarkan jenis arsip
        $totalMasuk = $arsipModel->where('jenis_arsip', 'Surat Masuk')->countAllResults();
        $totalKeluar = $arsipModel->where('jenis_arsip', 'Surat Keluar')->countAllResults();
        $totalNota = $arsipModel->where('jenis_arsip', 'Nota Dinas')->countAllResults();
        
        // Asumsi ada status 'pending' atau kita buat statis dulu jika belum ada kolomnya
        $menungguVerifikasi = 12; 

        // 2. Ambil 4 arsip terbaru yang ditambahkan ke sistem
        $aktivitasTerbaru = $arsipModel->orderBy('id_arsip', 'DESC')->limit(4)->find();

        $data = [
            'title'        => 'Dashboard Overview',
            'total_masuk'  => $totalMasuk,
            'total_keluar' => $totalKeluar,
            'total_nota'   => $totalNota,
            'menunggu'     => $menungguVerifikasi,
            'terbaru'      => $aktivitasTerbaru
        ];

        return view('staf/dashboard_view', $data);
    }
}