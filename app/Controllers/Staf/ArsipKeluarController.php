<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class ArsipKeluarController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        // 1. Ambil input pencarian dan filter dari View
        $keyword    = $this->request->getGet('keyword');
        $status     = $this->request->getGet('status');
        $tgl_dari   = $this->request->getGet('tgl_dari');
        $tgl_sampai = $this->request->getGet('tgl_sampai');

        // 2. Query Dasar: Hanya ambil 'Surat Keluar' dan Join dengan Lokasi
        $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
              ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
              ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
              ->where('data_arsip.jenis_arsip', 'Surat Keluar');

        // 3. Logika Pencarian Kata Kunci
        if ($keyword) {
            $model->groupStart()
                  ->like('data_arsip.nomor_surat', $keyword)
                  ->orLike('data_arsip.perihal', $keyword)
                  ->orLike('data_arsip.pengirim_tujuan', $keyword)
                  ->groupEnd();
        }

        // 4. Logika Filter Status
        if (!empty($status) && $status !== 'Semua Status') {
            $model->where('data_arsip.status', $status);
        }

        // 5. Logika Filter Tanggal (Rentang Waktu)
        if (!empty($tgl_dari) && !empty($tgl_sampai)) {
            $model->where('data_arsip.tanggal_surat >=', $tgl_dari)
                  ->where('data_arsip.tanggal_surat <=', $tgl_sampai);
        } elseif (!empty($tgl_dari)) {
            $model->where('data_arsip.tanggal_surat >=', $tgl_dari);
        } elseif (!empty($tgl_sampai)) {
            $model->where('data_arsip.tanggal_surat <=', $tgl_sampai);
        }

        // 6. Siapkan data untuk dikirim ke View
        $data = [
            'title' => 'Arsip Keluar',
            // Urutkan dari yang terbaru, tampilkan 10 per halaman
            'arsip' => $model->orderBy('data_arsip.tanggal_surat', 'DESC')->paginate(10, 'arsip'), 
            'pager' => $model->pager,
            
            // Kembalikan nilai ke View agar filter tidak kereset/kosong pas di-submit
            'filter_keyword'    => $keyword,
            'filter_status'     => $status,
            'filter_tgl_dari'   => $tgl_dari,
            'filter_tgl_sampai' => $tgl_sampai
        ];

        return view('staf/arsip_keluar/index_view', $data);
    }
}