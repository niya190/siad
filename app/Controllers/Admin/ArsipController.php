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
        $arsipModel = new \App\Models\ArsipModel();

        // 1. Ambil data dasar
        $jenis_arsip      = $this->request->getPost('jenis_arsip');
        $kode_klasifikasi = $this->request->getPost('kode_klasifikasi_text'); 
        $kode_bidang      = $this->request->getPost('kode_bidang'); // Input baru
        $no_urut          = $this->request->getPost('no_urut');
        $tahun            = $this->request->getPost('tahun');
        $tanggal_surat    = $this->request->getPost('tanggal_surat');
        $kode_satker      = 'DNV-TPI'; 
        
        $id_klas = $this->request->getPost('id_klasifikasi');

        // 2. Logika Cerdas Pembuatan Nomor
        if ($jenis_arsip == 'Nota Dinas') {
            // Hasil: SDMH/17/DNV-TPI/2026
            $nomor_surat = strtoupper($kode_bidang) . '/' . $no_urut . '/' . $kode_satker . '/' . $tahun;
            $id_klas = null; // Dikosongkan karena tidak pakai KKA
        } else {
            // Hasil: UM.001/17/DNV-TPI/III/2026
            $array_bulan = [1=>'I', 2=>'II', 3=>'III', 4=>'IV', 5=>'V', 6=>'VI', 7=>'VII', 8=>'VIII', 9=>'IX', 10=>'X', 11=>'XI', 12=>'XII'];
            $bulan_angka = (int)date('n', strtotime($tanggal_surat));
            $nomor_surat = $kode_klasifikasi . '/' . $no_urut . '/' . $kode_satker . '/' . $array_bulan[$bulan_angka] . '/' . $tahun;
        }

        // 3. Upload File PDF
        $fileScan = $this->request->getFile('file_scan');
        $namaFile = null;
        if ($fileScan && $fileScan->isValid() && ! $fileScan->hasMoved()) {
            $namaFile = $fileScan->getRandomName();
            $fileScan->move('uploads/arsip', $namaFile);
        }

        // 4. Data untuk di-save
        $data = [
            'id_klasifikasi'  => $id_klas, 
            'nomor_surat'     => $nomor_surat,
            'jenis_arsip'     => $jenis_arsip,
            'tanggal_surat'   => $tanggal_surat,
            'tanggal_terima'  => date('Y-m-d'),
            'pengirim_tujuan' => $this->request->getPost('pengirim_tujuan'),
            'perihal'         => $this->request->getPost('perihal'),
            'id_rak'          => $this->request->getPost('id_rak'),
            'file_scan'       => $namaFile,
            'id_petugas'      => session()->get('id_user') ?? 1 
        ];

        // 5. Eksekusi Simpan
        $arsipModel->insert($data);
        
        return redirect()->to(base_url('admin/arsip/search'))->with('success', 'Data arsip berhasil ditambahkan dengan nomor Srikandi!');
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
    // --- FUNGSI UNTUK MENAMPILKAN HALAMAN EDIT ARSIP ---
public function edit($id)
{
    $arsipModel = new \App\Models\ArsipModel();
    
    // Cari data arsip berdasarkan ID-nya
    $arsipData = $arsipModel->find($id);

    // Kalau datanya nggak ada, balikin ke halaman pencarian
    if (!$arsipData) {
        return redirect()->to('admin/arsip/search')->with('error', 'Data arsip tidak ditemukan!');
    }

    $data = [
        'title' => 'Edit Data Arsip',
        'arsip' => $arsipData // Ini data yang bakal diisi otomatis ke form
    ];

    return view('admin/arsip/edit_view', $data);
}

// --- FUNGSI UNTUK MENYIMPAN PERUBAHAN ARSIP KE DATABASE ---
public function update($id)
{
    $arsipModel = new \App\Models\ArsipModel();
    
    // 1. Ambil data arsip yang lama (buat ngecek file lama)
    $arsipLama = $arsipModel->find($id);

    // 2. Ambil data teks dari form
    $dataUpdate = [
        'id_arsip'       => $id,
        'nomor_surat'    => $this->request->getPost('nomor_surat'),
        'perihal'        => $this->request->getPost('perihal'),
        'tanggal_surat'  => $this->request->getPost('tanggal_surat'),
        'keterangan'     => $this->request->getPost('keterangan'),
        'jenis_arsip'    => $this->request->getPost('jenis_arsip'),
    ];

    // 3. LOGIKA UPLOAD FILE BARU
    $fileArsip = $this->request->getFile('file_scan');
    
    // Cek apakah ada file baru yang di-upload dan valid
    if ($fileArsip && $fileArsip->isValid() && !$fileArsip->hasMoved()) {
        
        // Generate nama file baru (biar gak bentrok namanya)
        $namaFileBaru = $fileArsip->getRandomName();
        
        // Pindahkan file baru ke folder public/uploads/arsip
        $fileArsip->move('uploads/arsip', $namaFileBaru);
        
        // Masukkan nama file baru ke data yang mau disimpan ke database
        $dataUpdate['file_scan'] = $namaFileBaru;

        // (Opsional & Bikin Rapi) Hapus file lama dari folder server biar gak menuh-menuhin memori
        if (!empty($arsipLama['file_scan']) && file_exists('uploads/arsip/' . $arsipLama['file_scan'])) {
            unlink('uploads/arsip/' . $arsipLama['file_scan']);
        }
    }

    // 4. Simpan semua perubahan ke database
    $arsipModel->save($dataUpdate);
    
    return redirect()->to('admin/arsip/search')->with('success', 'Data dan File Arsip berhasil diperbarui!');
}
    // ====================================================================
    // FITUR DETAIL ARSIP
    // ====================================================================
    public function detail($id)
    {
        $arsipModel = new \App\Models\ArsipModel();
        
        // Gunakan query builder untuk mengambil detail lengkap beserta relasinya
        $builder = $arsipModel->builder();
        $builder->select('data_arsip.*, master_klasifikasi.kode_klasifikasi, master_klasifikasi.nama_klasifikasi, 
                          master_rak.nama_rak, master_lemari.nama_lemari, master_ruangan.nama_ruangan, 
                          master_gedung.nama_gedung, users.nama_lengkap as nama_petugas');
        $builder->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left');
        $builder->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left');
        $builder->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left');
        $builder->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left');
        $builder->join('master_gedung', 'master_gedung.id_gedung = master_ruangan.id_gedung', 'left');
        $builder->join('users', 'users.id_user = data_arsip.id_petugas', 'left');
        $builder->where('data_arsip.id_arsip', $id);
        
        $arsip = $builder->get()->getRowArray();

        // Jika ID arsip tidak ada di database, kembalikan ke halaman pencarian
        if (!$arsip) {
            return redirect()->to(base_url('admin/arsip/search'))->with('error', 'Data arsip tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Arsip',
            'arsip' => $arsip
        ];

        // Tampilkan ke view
        return view('admin/arsip/detail_view', $data);
    }
}