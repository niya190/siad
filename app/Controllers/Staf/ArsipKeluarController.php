<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class ArsipKeluarController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        // Ambil input pencarian dan filter
        $keyword = $this->request->getGet('keyword');
        $status = $this->request->getGet('status');

        // Query Dasar: Hanya ambil 'Surat Keluar' dan Join dengan Lokasi
        $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
              ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
              ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
              ->where('data_arsip.jenis_arsip', 'Surat Keluar');

        // Logika Pencarian
        if ($keyword) {
            $model->groupStart()
                  ->like('data_arsip.nomor_surat', $keyword)
                  ->orLike('data_arsip.perihal', $keyword)
                  ->orLike('data_arsip.pengirim_tujuan', $keyword)
                  ->groupEnd();
        }

        // Logika Filter Status
        if (!empty($status) && $status !== 'Semua Status') {
            $model->where('data_arsip.status', $status);
        }

        $data = [
            'title' => 'Arsip Keluar',
            // Urutkan dari yang terbaru, tampilkan 10 per halaman
            'arsip' => $model->orderBy('data_arsip.tanggal_surat', 'DESC')->paginate(10, 'arsip'), 
            'pager' => $model->pager,
            // Kembalikan nilai ke View agar filter tidak kereset
            'filter_keyword' => $keyword,
            'filter_status' => $status
        ];

        return view('staf/arsip_keluar/index_view', $data);
    }
}