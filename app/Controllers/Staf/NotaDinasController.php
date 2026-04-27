<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class NotaDinasController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();
        
        // 1. Ambil input pencarian dan filter dari View
        $keyword    = $this->request->getGet('keyword');
        $tgl_dari   = $this->request->getGet('tgl_dari');
        $tgl_sampai = $this->request->getGet('tgl_sampai');

        // 2. Query Dasar: Hanya ambil 'Nota Dinas' dan Join dengan Lokasi
        $builder = $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
                         ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
                         ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
                         ->where('data_arsip.jenis_arsip', 'Nota Dinas');

        // 3. Logika Pencarian Kata Kunci
        if (!empty($keyword)) {
            $builder->groupStart()
                    ->like('data_arsip.nomor_surat', $keyword)
                    ->orLike('data_arsip.perihal', $keyword)
                    ->groupEnd();
        }

        // 4. Logika Filter Tanggal (Rentang Waktu)
        if (!empty($tgl_dari) && !empty($tgl_sampai)) {
            $builder->where('data_arsip.tanggal_surat >=', $tgl_dari)
                    ->where('data_arsip.tanggal_surat <=', $tgl_sampai);
        } elseif (!empty($tgl_dari)) {
            $builder->where('data_arsip.tanggal_surat >=', $tgl_dari);
        } elseif (!empty($tgl_sampai)) {
            $builder->where('data_arsip.tanggal_surat <=', $tgl_sampai);
        }

        // 5. Siapkan data untuk dikirim ke View
        $data = [
            'title'             => 'Nota Dinas',
            'arsip'             => $builder->orderBy('data_arsip.id_arsip', 'DESC')->paginate(10, 'arsip'),
            'pager'             => $model->pager,
            
            // Kembalikan nilai ke View agar filter tidak kereset/kosong pas di-submit
            'filter_keyword'    => $keyword ?? '',
            'filter_tgl_dari'   => $tgl_dari ?? '',
            'filter_tgl_sampai' => $tgl_sampai ?? ''
        ];

        return view('staf/nota_dinas/index_view', $data);
    }
}