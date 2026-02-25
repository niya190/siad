<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class ArsipMasukController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();

        // Ambil input dari form pencarian & filter
        $keyword = $this->request->getGet('keyword');
        $tgl_dari = $this->request->getGet('tgl_dari');
        $tgl_sampai = $this->request->getGet('tgl_sampai');
        $status = $this->request->getGet('status');

        // Query Dasar: Gunakan nama tabel 'data_arsip' sesuai Model kamu
        $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
              ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
              ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
              ->where('data_arsip.jenis_arsip', 'Surat Masuk');

        // Logika Filter Pencarian
        if ($keyword) {
            $model->groupStart()
                  ->like('data_arsip.nomor_surat', $keyword)
                  ->orLike('data_arsip.perihal', $keyword)
                  ->orLike('data_arsip.pengirim_tujuan', $keyword) // Pakai pengirim_tujuan
                  ->groupEnd();
        }
        
        // Logika Filter Tanggal
        if ($tgl_dari && $tgl_sampai) {
            $model->where('data_arsip.tanggal_surat >=', $tgl_dari)
                  ->where('data_arsip.tanggal_surat <=', $tgl_sampai);
        }

        // Logika Filter Status
        if ($status) {
            // Karena status biasanya disimpen huruf kecil/sesuai DB, kita sesuaikan
            $model->where('data_arsip.status', $status); 
        }

        // Kemas data untuk dikirim ke View
        $data = [
            'title' => 'Arsip Masuk',
            // Urutkan berdasarkan tanggal terbaru dan buat pagination
            'arsip' => $model->orderBy('data_arsip.created_at', 'DESC')->paginate(10, 'arsip'), 
            'pager' => $model->pager,
            // Kembalikan nilai filter ke form
            'filter_keyword' => $keyword,
            'filter_tgl_dari' => $tgl_dari,
            'filter_tgl_sampai' => $tgl_sampai,
            'filter_status' => $status
        ];

        return view('staf/arsip_masuk/index_view', $data);
    }
}