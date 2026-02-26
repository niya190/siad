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
    // ====================================================================
    // FITUR EXPORT LAPORAN
    // ====================================================================
    public function export()
    {
        $klasifikasiModel = new \App\Models\KlasifikasiModel();
        $ruanganModel     = new \App\Models\RuanganModel();
        $lemariModel      = new \App\Models\LemariModel();

        $data = [
            'title'       => 'Export Record',
            'klasifikasi' => $klasifikasiModel->findAll(),
            'ruangan'     => $ruanganModel->findAll(),
            'lemari'      => $lemariModel->findAll(),
        ];

        return view('admin/arsip/export_view', $data);
    }

    public function processExport()
    {
        $arsipModel = new \App\Models\ArsipModel();

        // 1. Tangkap semua input filter dari form
        $startDate  = $this->request->getPost('start_date');
        $endDate    = $this->request->getPost('end_date');
        $jenisArsip = $this->request->getPost('jenis_arsip');
        $ruangan    = $this->request->getPost('ruangan');
        $lemari     = $this->request->getPost('lemari');
        $format     = $this->request->getPost('format'); 

        // 2. Query dasar (STATUS SAYA GANTI JADI KETERANGAN BIAR TIDAK ERROR)
        $builder = $arsipModel->select('data_arsip.nomor_surat, data_arsip.jenis_arsip, data_arsip.perihal, data_arsip.tanggal_surat, data_arsip.pengirim_tujuan, data_arsip.keterangan, master_klasifikasi.nama_klasifikasi, master_ruangan.nama_ruangan, master_lemari.nama_lemari, master_rak.nama_rak')
            ->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left')
            ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
            ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
            ->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left');

        // 3. Terapkan Filter
        if (!empty($startDate))  $builder->where('data_arsip.tanggal_surat >=', $startDate);
        if (!empty($endDate))    $builder->where('data_arsip.tanggal_surat <=', $endDate);
        if (!empty($jenisArsip) && $jenisArsip != 'All Types') $builder->where('data_arsip.jenis_arsip', $jenisArsip);
        if (!empty($ruangan) && $ruangan != 'All Rooms')       $builder->where('master_ruangan.nama_ruangan', $ruangan);
        if (!empty($lemari) && $lemari != 'All Cabinets')      $builder->where('master_lemari.nama_lemari', $lemari);

        $dataArsip = $builder->orderBy('data_arsip.tanggal_surat', 'DESC')->findAll();

        // 4. Logika Pembuatan File CSV
        if ($format == 'csv' || $format == 'excel') {
            $filename = 'Export_Arsip_' . date('Ymd_His') . '.csv';

            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; charset=UTF-8");

            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM agar Excel membaca karakter dengan benar
            fputs($file, "\xEF\xBB\xBF"); 

            // Tulis Judul Kolom (Status diganti Keterangan)
            $header = array("Nomor Surat", "Jenis Arsip", "Perihal", "Tanggal Surat", "Pengirim/Tujuan", "Klasifikasi", "Ruangan", "Lemari", "Rak", "Keterangan");
            fputcsv($file, $header);

            // Tulis Baris Data
            foreach ($dataArsip as $row) {
                fputcsv($file, array(
                    $row['nomor_surat'],
                    $row['jenis_arsip'],
                    $row['perihal'],
                    $row['tanggal_surat'],
                    $row['pengirim_tujuan'],
                    $row['nama_klasifikasi'] ?? '-',
                    $row['nama_ruangan'] ?? '-',
                    $row['nama_lemari'] ?? '-',
                    $row['nama_rak'] ?? '-',
                    $row['keterangan'] ?? '-'
                ));
            }
            fclose($file);
            exit; 
        } 
        
        return redirect()->back()->with('error', 'Format PDF membutuhkan library tambahan. Silakan gunakan format Excel (CSV).');
    }
}