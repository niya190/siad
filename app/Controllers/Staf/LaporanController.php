<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('data_arsip');
        
        // Relasi ke Klasifikasi dan Hierarki Lokasi (Rak -> Lemari -> Ruangan -> Gedung)
        $builder->select('data_arsip.*, master_klasifikasi.kode_klasifikasi, 
                          master_rak.nama_rak, master_lemari.nama_lemari, 
                          master_ruangan.nama_ruangan, master_gedung.nama_gedung');
        
        $builder->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left');
        
        // JOIN Berantai untuk Lokasi
        $builder->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left');
        $builder->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left');
        $builder->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left');
        $builder->join('master_gedung', 'master_gedung.id_gedung = master_ruangan.id_gedung', 'left');

        // 1. Tangkap Request Filter dari View
        $start_date  = $this->request->getGet('start_date');
        $end_date    = $this->request->getGet('end_date');
        $jenis_arsip = $this->request->getGet('jenis_arsip');

        // 2. Terapkan Filter jika diisi
        if (!empty($start_date) && !empty($end_date)) {
            $builder->where('tanggal_surat >=', $start_date);
            $builder->where('tanggal_surat <=', $end_date);
        }
        
        if (!empty($jenis_arsip)) {
            $builder->where('jenis_arsip', $jenis_arsip);
        }

        $builder->orderBy('tanggal_surat', 'DESC');
        $arsip = $builder->get()->getResultArray();

        $data = [
            'title'       => 'Laporan Arsip',
            'arsip'       => $arsip,
            'start_date'  => $start_date,
            'end_date'    => $end_date,
            'jenis_arsip' => $jenis_arsip
        ];

        return view('staf/laporan/index_view', $data);
    }
}