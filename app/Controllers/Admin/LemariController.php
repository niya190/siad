<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LemariModel;

class LemariController extends BaseController
{
    public function index()
    {
        $lemariModel = new LemariModel();
        $semua_lemari = $lemariModel->findAll();

        $total_kapasitas = 0;
        $total_terisi = 0;
        $lemari_kritis = 0;

        foreach ($semua_lemari as $l) {
            $total_kapasitas += $l['kapasitas_maksimal'];
            $total_terisi += $l['jumlah_terisi'];
            
            // Cek apakah ada yang di atas 90%
            if ($l['kapasitas_maksimal'] > 0) {
                $persen = ($l['jumlah_terisi'] / $l['kapasitas_maksimal']) * 100;
                if ($persen >= 90) $lemari_kritis++;
            }
        }

        $data = [
            'title'           => 'Manajemen Lemari',
            'daftar_lemari'   => $semua_lemari,
            'total_lemari'    => count($semua_lemari),
            'total_kapasitas' => $total_kapasitas,
            'slot_tersedia'   => $total_kapasitas - $total_terisi,
            'lemari_kritis'   => $lemari_kritis
        ];

        return view('admin/lemari/index_view', $data);
    }

    public function simpan()
    {
        $lemariModel = new LemariModel();

        // Hitung total kapasitas otomatis (Jumlah Rak x Kapasitas per Rak)
        $jml_rak = $this->request->getPost('jumlah_rak');
        $kaps_rak = $this->request->getPost('kapasitas_per_rak');
        $kapasitas_maksimal = $jml_rak * $kaps_rak;

        $lemariModel->save([
            'nama_lemari'        => $this->request->getPost('nama_lemari'),
            'lokasi_ruangan'     => $this->request->getPost('lokasi_ruangan'),
            'jumlah_rak'         => $jml_rak,
            'kapasitas_per_rak'  => $kaps_rak,
            'kapasitas_maksimal' => $kapasitas_maksimal,
            'jumlah_terisi'      => 0 // Lemari baru isinya 0
        ]);

        return redirect()->to('admin/lemari')->with('success', 'Lemari berhasil ditambahkan!');
    }
}