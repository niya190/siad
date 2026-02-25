<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $arsipModel = new ArsipModel();

        // 1. Hitung Total Arsip
        $totalArchives = $arsipModel->countAllResults();

        // 2. Hitung Arsip Baru (Dalam 7 hari terakhir)
        $tujuhHariLalu = date('Y-m-d', strtotime('-7 days'));
        $newEntries = $arsipModel->where('tanggal_terima >=', $tujuhHariLalu)->countAllResults();

        // 3. Ambil 5 Arsip Terbaru untuk Tabel
        // Pastikan Anda sudah punya method getArsipLengkap di model seperti yang kita bahas sebelumnya
        $recentArchives = $arsipModel->select('data_arsip.*, master_klasifikasi.nama_klasifikasi')
                                     ->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left')
                                     ->orderBy('tanggal_terima', 'DESC')
                                     ->findAll(5);

        // Siapkan data untuk dikirim ke View
        $data = [
            'title'            => 'Dashboard Admin',
            'total_archives'   => $totalArchives,
            'new_entries'      => $newEntries,
            'expiring_records' => 0, // Ini bisa kita kembangkan nanti jika ada fitur retensi usia arsip
            'recent_archives'  => $recentArchives
        ];

        return view('admin/dashboard_view', $data);
    }
}