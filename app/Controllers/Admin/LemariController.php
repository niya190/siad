<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RuanganModel;
use App\Models\LemariModel;
use App\Models\RakModel;
use App\Models\KlasifikasiModel;

class LemariController extends BaseController
{
    public function index()
    {
        $ruanganModel = new RuanganModel();
        $lemariModel = new LemariModel();
        $rakModel = new RakModel();
        $klasifikasiModel = new KlasifikasiModel();

        // 1. Ambil Angka Statistik untuk Dashboard Atas
        $totalRooms = $ruanganModel->countAllResults();
        $totalCabinets = $lemariModel->countAllResults();
        $totalShelves = $rakModel->countAllResults();
        $totalCategories = $klasifikasiModel->countAllResults();

        // 2. Ambil Data Hierarki (Pohon) Lokasi Fisik: Ruangan -> Lemari -> Rak
        $ruanganTree = $ruanganModel->findAll();
        foreach ($ruanganTree as &$room) {
            // Cari lemari yang ada di dalam ruangan ini
            $cabinets = $lemariModel->where('id_ruangan', $room['id_ruangan'])->findAll();
            foreach ($cabinets as &$cabinet) {
                // Cari rak yang ada di dalam lemari ini
                $cabinet['shelves'] = $rakModel->where('id_lemari', $cabinet['id_lemari'])->findAll();
            }
            // Masukkan data lemari beserta rak-raknya ke dalam array ruangan
            $room['cabinets'] = $cabinets;
        }

        $data = [
            'title'            => 'Archive Manager',
            'total_rooms'      => $totalRooms,
            'total_cabinets'   => $totalCabinets,
            'total_shelves'    => $totalShelves,
            'total_categories' => $totalCategories,
            'ruangan_tree'     => $ruanganTree,
            'klasifikasi'      => $klasifikasiModel->findAll()
        ];

        return view('admin/lemari/index_view', $data);
    }
}