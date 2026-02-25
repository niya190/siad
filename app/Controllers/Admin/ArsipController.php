<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\KlasifikasiModel;
use App\Models\RuanganModel;   // <-- PASTIKAN BARIS INI ADA!
use App\Models\LemariModel;    // <-- INI JUGA!
use App\Models\RakModel;

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
    // Menampilkan halaman form
    public function create()
    {
        $klasifikasiModel = new KlasifikasiModel();
        $ruanganModel = new RuanganModel();

        $data = [
            'title'       => 'Add New Archive',
            'klasifikasi' => $klasifikasiModel->findAll(),
            'ruangan'     => $ruanganModel->findAll()
        ];

        return view('admin/arsip/create_view', $data);
    }

    // Memproses data yang dikirim dari form
    public function save()
    {
        $arsipModel = new ArsipModel();

        // Menggabungkan Kode Klasifikasi, No Urut, dan Tahun menjadi Nomor Surat Kemenhub (Misal: KP.102/0045/2024)
        $kode_klasifikasi = $this->request->getPost('kode_klasifikasi_text'); 
        $no_urut          = $this->request->getPost('no_urut');
        $tahun            = $this->request->getPost('tahun');
        $nomor_surat      = $kode_klasifikasi . '/' . $no_urut . '/' . $tahun;

        // Proses Upload File Scan (Opsional)
        $fileScan = $this->request->getFile('file_scan');
        $namaFile = null;
        if ($fileScan && $fileScan->isValid() && ! $fileScan->hasMoved()) {
            $namaFile = $fileScan->getRandomName();
            $fileScan->move('uploads/arsip', $namaFile);
        }

        // Simpan ke Database
        $arsipModel->insert([
            'id_klasifikasi'  => $this->request->getPost('id_klasifikasi'),
            'nomor_surat'     => $nomor_surat,
            'jenis_arsip'     => $this->request->getPost('jenis_arsip'),
            'tanggal_surat'   => $this->request->getPost('tanggal_surat'),
            'tanggal_terima'  => date('Y-m-d'), // Tanggal hari ini di-input
            'pengirim_tujuan' => $this->request->getPost('pengirim_tujuan'),
            'perihal'         => $this->request->getPost('perihal'),
            'id_rak'          => $this->request->getPost('id_rak'), // Lokasi rak final
            'file_scan'       => $namaFile,
            'id_petugas'      => session()->get('id_user') ?? 1 // ID User yang login
        ]);

        return redirect()->to(base_url('admin/arsip/search'))->with('success', 'Data arsip berhasil disimpan!');
    }

    // === FUNGSI AJAX UNTUK DROPDOWN LOKASI DINAMIS ===
    public function getLemari()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $lemariModel = new LemariModel();
        return $this->response->setJSON($lemariModel->where('id_ruangan', $id_ruangan)->findAll());
    }

    public function getRak()
    {
        $id_lemari = $this->request->getPost('id_lemari');
        $rakModel = new RakModel();
        return $this->response->setJSON($rakModel->where('id_lemari', $id_lemari)->findAll());
    }
}