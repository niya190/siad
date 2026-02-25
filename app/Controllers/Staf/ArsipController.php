<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class ArsipController extends BaseController
{
    public function index()
    {
        $arsipModel = new ArsipModel();

        // 1. Tangkap inputan dari form pencarian (GET)
        $keyword = $this->request->getGet('keyword');
        $jenis   = $this->request->getGet('jenis_arsip');

        // 2. Logika Pencarian (Jika ada keyword yang diketik)
        if (!empty($keyword)) {
            $arsipModel->groupStart()
                       ->like('nomor_surat', $keyword)
                       ->orLike('perihal', $keyword) // Asumsi nama kolom di DB 'perihal'
                       ->orLike('pengirim_tujuan', $keyword)
                       ->groupEnd();
        }

        // 3. Logika Filter (Jika dropdown jenis surat dipilih)
        if (!empty($jenis) && $jenis != 'Semua') {
            $arsipModel->where('jenis_arsip', $jenis);
        }

        // 4. Ambil datanya (Bisa ditambahin orderBy biar yang terbaru di atas)
        // Pastikan nama kolom tanggalnya sesuai dengan database kamu (misal: tanggal_terima)
        $daftar_arsip = $arsipModel->orderBy('id_arsip', 'DESC')->findAll();

        $data = [
            'title'   => 'Pencarian Naskah Dinas',
            'arsip'   => $daftar_arsip,
            'keyword' => $keyword, // Kirim balik ke view biar teksnya gak hilang
            'jenis'   => $jenis
        ];

        // Pastikan layout view-nya mengarah ke folder yang benar
        return view('staf/arsip/index_view', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Batch Digitalization (Input Arsip Baru)'
        ];

        return view('staf/arsip/create_view', $data);
    }
}