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
        // Pastikan memanggil model yang dibutuhkan
        $klasifikasiModel = new \App\Models\KlasifikasiModel();
        $ruanganModel = new \App\Models\RuanganModel();

        // Siapkan data untuk dikirim ke View
        $data = [
            'title'       => 'Rekam Arsip Baru',
            'klasifikasi' => $klasifikasiModel->findAll(),
            'ruangan'     => $ruanganModel->findAll(),
            
            // INI YANG BIKIN ERROR TADI (Variabelnya ketinggalan)
            'opsi_jenis'  => ['Surat Masuk', 'Surat Keluar', 'Nota Dinas'] 
        ];

        return view('staf/arsip/create_view', $data);
    }
    public function detail($id)
    {
        $model = new ArsipModel();

        // Mengambil data arsip beserta data relasi (Klasifikasi dan Lokasi Fisik)
        $arsip = $model->select('data_arsip.*, master_klasifikasi.nama_klasifikasi, master_rak.nama_rak, master_lemari.nama_lemari, master_ruangan.nama_ruangan')
            ->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left')
            ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
            ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
            ->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left')
            ->where('data_arsip.id_arsip', $id)
            ->first();

        // Jika arsip tidak ditemukan (mencegah error kalau user mengarang ID di URL)
        if (!$arsip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumen arsip tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Dokumen - ' . $arsip['nomor_surat'],
            'arsip' => $arsip
        ];

        return view('staf/arsip/detail_view', $data);
    }
}