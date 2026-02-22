<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GedungModel;
use App\Models\RuanganModel;

class GedungController extends BaseController
{
    public function index()
    {
        $gedungModel = new GedungModel();
        $ruanganModel = new RuanganModel();

        $semua_gedung = $gedungModel->findAll();
        $semua_ruangan = $ruanganModel->findAll();

        $data_gedung = [];
        $total_hunian = 0;

        // Looping untuk nyusun data ruangan ke dalam gedung masing-masing
        foreach ($semua_gedung as $g) {
            $ruangan_gedung = $ruanganModel->where('id_gedung', $g['id_gedung'])->findAll();
            
            // Rumus hitung persentase hunian (yg statusnya bukan Tersedia = Terisi)
            $terisi = 0;
            foreach($ruangan_gedung as $r) {
                if($r['status_ruangan'] != 'Tersedia') $terisi++;
            }
            
            $persen_hunian = count($ruangan_gedung) > 0 ? round(($terisi / count($ruangan_gedung)) * 100) : 0;
            $total_hunian += $persen_hunian;

            $g['daftar_ruangan'] = $ruangan_gedung;
            $g['persen_hunian'] = $persen_hunian;
            
            $data_gedung[] = $g; // Masukkan ke array utama
        }

        // Rata-rata hunian semua gedung
        $rata_hunian = count($semua_gedung) > 0 ? round($total_hunian / count($semua_gedung)) : 0;

        $data = [
            'title'         => 'Manajemen Gedung & Ruang',
            'total_gedung'  => count($semua_gedung),
            'total_ruangan' => count($semua_ruangan),
            'rata_hunian'   => $rata_hunian,
            'gedung_list'   => $data_gedung
        ];
        
        return view('admin/gedung/index_view', $data);
    }
}