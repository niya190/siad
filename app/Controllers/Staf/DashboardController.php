<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 1. MENGHITUNG KOTAK STATISTIK ATAS
        $total_masuk = $db->table('data_arsip')->where('jenis_arsip', 'Surat Masuk')->countAllResults();
        $total_keluar = $db->table('data_arsip')->where('jenis_arsip', 'Surat Keluar')->countAllResults();
        $total_nota = $db->table('data_arsip')->where('jenis_arsip', 'Nota Dinas')->countAllResults();
        $total_arsip = $db->table('data_arsip')->countAllResults();

        // 2. MENGHITUNG GRAFIK TREN BULANAN (Tahun Ini)
        $tahun_ini = date('Y');
        $grafik = [];
        $nama_bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jumlah = $db->table('data_arsip')
                         ->where('YEAR(tanggal_surat)', $tahun_ini)
                         ->where('MONTH(tanggal_surat)', $bulan)
                         ->countAllResults();
            $grafik[] = [
                'bulan' => $nama_bulan[$bulan - 1],
                'jumlah' => $jumlah
            ];
        }
        
        // Cari nilai tertinggi di grafik untuk acuan tinggi bar chart (maks 100%)
        $max_grafik = max(array_column($grafik, 'jumlah'));
        $max_grafik = $max_grafik > 0 ? $max_grafik : 1; // Hindari pembagian 0

        // 3. MENGAMBIL NOTIFIKASI / AKTIVITAS TERBARU (Bisa diklik)
        $builder = $db->table('data_arsip');
        $builder->select('data_arsip.id_arsip, data_arsip.nomor_surat, data_arsip.created_at, data_arsip.updated_at, users.nama_lengkap');
        $builder->join('users', 'users.id_user = data_arsip.id_petugas', 'left');
        $builder->orderBy('data_arsip.updated_at', 'DESC');
        $builder->limit(5); // Ambil 5 terakhir saja
        $aktivitas = $builder->get()->getResultArray();

        $data = [
            'title'        => 'Dashboard Staf',
            'total_masuk'  => $total_masuk,
            'total_keluar' => $total_keluar,
            'total_nota'   => $total_nota,
            'total_arsip'  => $total_arsip,
            'grafik'       => $grafik,
            'max_grafik'   => $max_grafik,
            'aktivitas'    => $aktivitas
        ];

        return view('staf/dashboard_view', $data);
    }
}