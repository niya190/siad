<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\KlasifikasiModel;

class ArsipController extends BaseController
{
   public function search()
    {
        $arsipModel = new ArsipModel();
        // Pastikan model klasifikasi ada agar opsi dropdown-nya bisa terisi otomatis dari DB
        $klasifikasiModel = new KlasifikasiModel(); 

        // 1. Menangkap semua nilai (value) yang diketik/dipilih user di Form UI kamu
        $filters = [
            'keyword'        => $this->request->getGet('keyword'),
            'nomor_surat'    => $this->request->getGet('nomor_surat'),
            'id_klasifikasi' => $this->request->getGet('id_klasifikasi'),
            'start_date'     => $this->request->getGet('start_date'),
            'end_date'       => $this->request->getGet('end_date'),
            'tahun'          => $this->request->getGet('tahun'),
            'pengirim'       => $this->request->getGet('pengirim'),
            'tujuan'         => $this->request->getGet('tujuan'),
            'ruangan'        => $this->request->getGet('ruangan'),
            'lemari'         => $this->request->getGet('lemari'),
            'rak'            => $this->request->getGet('rak'),
        ];

        // 2. Masukkan input tersebut ke mesin pencari di Model
        $query = $arsipModel->getAdvancedSearch($filters);

        // 3. Konfigurasi Pagination (Berapa baris data per halaman? Misal: 10 baris)
        $perPage = 10;

        // 4. Siapkan Paket Data untuk dikirim ke Desain UI (View)
        $data = [
            'title'       => 'Search Archives',
            'klasifikasi' => $klasifikasiModel->findAll(), // Panggil master klasifikasi utk dropdown
            'arsip'       => $query->paginate($perPage, 'arsip'), // Ambil data yang sudah terfilter
            'pager'       => $arsipModel->pager, // Generate tombol Next/Prev Pagination
            'total_data'  => $arsipModel->pager->getTotal('arsip'), // Hitung total arsip yg ketemu
            'filters'     => $filters // Balikkan ketikan user agar form-nya tidak reset/kosong sendiri
        ];

        // 5. Tampilkan ke Desain UI kamu
        return view('admin/arsip/search_view', $data);
    }
}