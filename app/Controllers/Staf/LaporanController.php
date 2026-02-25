<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class LaporanController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        // Tangkap input filter tanggal
        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        // --- MENGHITUNG STATISTIK KARTU ATAS ---
        $db = \Config\Database::connect();
        $builderStat = $db->table('data_arsip');
        
        // Jika ada filter tanggal, terapkan ke statistik
        if ($startDate && $endDate) {
            $builderStat->where('tanggal_surat >=', $startDate)
                        ->where('tanggal_surat <=', $endDate);
        }
        
        $totalArsip = $builderStat->countAllResults(false); // Hitung total
        $arsipDigital = $builderStat->where('file_scan IS NOT NULL')->countAllResults(); // Hitung yg ada file digitalnya
        $persenDigital = ($totalArsip > 0) ? round(($arsipDigital / $totalArsip) * 100) : 0;

        // --- MENGAMBIL DATA UNTUK TABEL PREVIEW ---
        $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
              ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
              ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left');

        if ($startDate && $endDate) {
            $model->where('tanggal_surat >=', $startDate)
                  ->where('tanggal_surat <=', $endDate);
        }

        $data = [
            'title' => 'Laporan & Statistik',
            'arsip' => $model->orderBy('data_arsip.created_at', 'DESC')->paginate(10, 'arsip'),
            'pager' => $model->pager,
            'total_arsip'   => $totalArsip,
            'arsip_digital' => $arsipDigital,
            'persen_digital'=> $persenDigital,
            'start_date'    => $startDate,
            'end_date'      => $endDate
        ];

        return view('staf/laporan/index_view', $data);
    }
}