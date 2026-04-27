<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;

class PenyimpananController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Query untuk mengambil Ruangan, menghitung Lemari, Rak, dan Arsip
        $builder = $db->table('master_ruangan');
        $builder->select('
            master_ruangan.id_ruangan, 
            master_ruangan.nama_ruangan, 
            COUNT(DISTINCT master_lemari.id_lemari) as total_lemari, 
            COUNT(DISTINCT master_rak.id_rak) as total_rak,
            COUNT(DISTINCT data_arsip.id_arsip) as total_arsip
        ');
        $builder->join('master_lemari', 'master_lemari.id_ruangan = master_ruangan.id_ruangan', 'left');
        $builder->join('master_rak', 'master_rak.id_lemari = master_lemari.id_lemari', 'left');
        // Join ke data_arsip untuk menghitung isi aslinya
        $builder->join('data_arsip', 'data_arsip.id_rak = master_rak.id_rak', 'left'); 
        $builder->groupBy('master_ruangan.id_ruangan');
        
        $ruangan = $builder->get()->getResultArray();

        $data = [
            'title'   => 'Kelola Penyimpanan',
            'ruangan' => $ruangan
        ];

        return view('staf/penyimpanan/index_view', $data);
    }
    public function detail($id_ruangan)
    {
        $db = \Config\Database::connect();
        
        // 1. Ambil data ruangan & gedungnya
        $ruangan = $db->table('master_ruangan')
            ->join('master_gedung', 'master_gedung.id_gedung = master_ruangan.id_gedung', 'left')
            ->where('master_ruangan.id_ruangan', $id_ruangan)
            ->get()->getRowArray();

        if (!$ruangan) {
            return redirect()->to(base_url('staf/penyimpanan'))->with('error', 'Ruangan tidak ditemukan.');
        }

        // 2. Ambil data lemari di ruangan ini
        $lemari = $db->table('master_lemari')
            ->where('id_ruangan', $id_ruangan)
            ->get()->getResultArray();

        // 3. Ambil data rak & arsip sekaligus
        $rak = [];
        $arsip = [];
        if (!empty($lemari)) {
            $lemariIds = array_column($lemari, 'id_lemari');
            
            $rak = $db->table('master_rak')
                ->whereIn('id_lemari', $lemariIds)
                ->get()->getResultArray();

            if (!empty($rak)) {
                $rakIds = array_column($rak, 'id_rak');
                // Ambil daftar surat yang tersimpan di ruangan ini
                $arsip = $db->table('data_arsip')
                    ->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left')
                    ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
                    ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
                    ->whereIn('data_arsip.id_rak', $rakIds)
                    ->orderBy('data_arsip.created_at', 'DESC')
                    ->get()->getResultArray();
            }
        }

        $data = [
            'title'   => 'Detail Ruangan: ' . $ruangan['nama_ruangan'],
            'ruangan' => $ruangan,
            'lemari'  => $lemari,
            'rak'     => $rak,
            'arsip'   => $arsip
        ];

        return view('staf/penyimpanan/detail_view', $data);
    }
}