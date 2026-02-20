<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use Dompdf\Dompdf;

class ArsipController extends BaseController
{
    protected $arsipModel;

    public function __construct()
    {
        $this->arsipModel = new ArsipModel();
    }

    // 1. Tampilan Utama (Tabel Data mirip Excel)
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $jenis   = $this->request->getGet('jenis');

        $data = [
            'title' => 'Data Arsip Navigasi',
            'arsip' => $this->arsipModel->cariData($keyword, $jenis),
            'keyword' => $keyword,
            'filter_jenis' => $jenis
        ];
        return view('staf/arsip/index_view', $data);
    }

    // 2. Form Input Data Baru
    public function create()
    {
        $data = [
            'title' => 'Input Arsip Baru',
            // Opsi Jenis sesuai Excel REFERENSI
            'opsi_jenis' => [
                'Surat Masuk', 
                'Surat Keluar', 
                'SK (Keputusan)', 
                'Berkas Proyek'
            ]
        ];
        return view('staf/arsip/create_view', $data);
    }

    // 3. Proses Simpan (Dengan Logika Otomatis Lokasi)
    public function save()
    {
        if (!$this->validate([
            'nomor_surat' => 'required',
            // Validasi Khusus PDF
            'file_scan'   => [
                'rules'  => 'max_size[file_scan,10240]|ext_in[file_scan,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar (Maks 10MB)',
                    'ext_in'   => 'Wajib upload file format .PDF agar bisa divalidasi (TTE).'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek inputan Anda. Nomor Surat wajib diisi.');
        }

        // --- LOGIKA OTOMATIS PENENTUAN LOKASI (SESUAI EXCEL REFERENSI) ---
        $jenis = $this->request->getPost('jenis_arsip');
        $lokasi = 'Belum Ditentukan';

        switch ($jenis) {
            case 'Surat Masuk':
                $lokasi = 'Lemari A - Rak 1';
                break;
            case 'Surat Keluar':
                $lokasi = 'Lemari A - Rak 2';
                break;
            case 'SK (Keputusan)':
                $lokasi = 'Lemari B - Box 1';
                break;
            case 'Berkas Proyek':
                $lokasi = 'Gudang Arsip';
                break;
            default:
                $lokasi = 'Rak Umum';
        }
        // ------------------------------------------------------------------

        // Upload File
        $file = $this->request->getFile('file_scan');
        $namaFile = null;
        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/arsip', $namaFile);
        }

        $this->arsipModel->save([
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'jenis_arsip' => $jenis,
            'kode_klasifikasi' => $this->request->getPost('kode_klasifikasi'), // <-- TAMBAHAN
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'pengirim_tujuan' => $this->request->getPost('pengirim_tujuan'),
            'perihal' => $this->request->getPost('perihal'),
            'lokasi_penyimpanan' => $lokasi, // <-- Terisi Otomatis!
            'keterangan' => $this->request->getPost('keterangan'),
            'file_scan' => $namaFile,
            'id_petugas' => session()->get('id_user')
        ]);

        return redirect()->to('/staf/arsip')->with('success', "Data tersimpan! Lokasi Otomatis: <b>$lokasi</b>");
    }
    
    // Fitur Hapus
    public function delete($id)
    {
        $this->arsipModel->delete($id);
        return redirect()->to('/staf/arsip')->with('success', 'Data arsip dihapus.');
    }

    public function exportPDF($id)
    {
        $arsip = $this->arsipModel->find($id);

        if (!$arsip) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ambil nama petugas
        $userModel = new \App\Models\UserModel();
        $petugas = $userModel->find($arsip['id_petugas']);

        $data = [
            'arsip' => $arsip,
            'petugas' => $petugas
        ];

        // Generate PDF
        $dompdf = new Dompdf();
        
        // Kita akan buat file view baru khusus cetak
        $dompdf->loadHtml(view('staf/arsip/print_view', $data));
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Nama file saat didownload: Arsip_NomorSurat.pdf
        $namaFile = 'Kartu_Arsip_' . str_replace(['/','.'], '-', $arsip['nomor_surat']);
        $dompdf->stream($namaFile, ["Attachment" => 0]); // 0 = Preview, 1 = Download langsung
    }
    // MENAMPILKAN FORM EDIT
    public function edit($id)
    {
        $arsip = $this->arsipModel->find($id);
        if (!$arsip) return redirect()->to('/staf/arsip');

        $data = [
            'title' => 'Edit Data Arsip',
            'arsip' => $arsip,
            'opsi_jenis' => ['Surat Masuk', 'Surat Keluar', 'SK (Surat Keputusan)', 'Berkas Proyek']
        ];
        return view('staf/arsip/edit_view', $data);
    }

    // PROSES UPDATE DATA
    public function update($id)
    {
        // Validasi
        if (!$this->validate(['nomor_surat' => 'required'])) {
            return redirect()->back()->withInput()->with('error', 'Nomor surat wajib diisi.');
        }

        // Tentukan Lokasi Baru (Jika jenis berubah)
        $jenis = $this->request->getPost('jenis_arsip');
        $lokasi = '-';
        switch ($jenis) {
            case 'Surat Masuk': $lokasi = 'Lemari A - Rak 1'; break;
            case 'Surat Keluar': $lokasi = 'Lemari A - Rak 2'; break;
            case 'SK (Surat Keputusan)': $lokasi = 'Lemari B - Box 1'; break;
            case 'Berkas Proyek': $lokasi = 'Gudang Arsip'; break;
            default: $lokasi = 'Rak Umum';
        }

        // Cek apakah ada file baru diupload?
        $file = $this->request->getFile('file_scan');
        $namaFile = $this->request->getPost('file_lama'); // Default pakai file lama

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/arsip', $namaFile);
        }

        $this->arsipModel->update($id, [
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'jenis_arsip' => $jenis,
            'kode_klasifikasi' => $this->request->getPost('kode_klasifikasi'), // <-- TAMBAHAN
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat'),
            'pengirim_tujuan' => $this->request->getPost('pengirim_tujuan'),
            'perihal' => $this->request->getPost('perihal'),
            'lokasi_penyimpanan' => $lokasi, // Lokasi update otomatis
            'keterangan' => $this->request->getPost('keterangan'),
            // Validasi Khusus PDF
            'file_scan'   => [
                'rules'  => 'max_size[file_scan,10240]|ext_in[file_scan,pdf]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar (Maks 10MB)',
                    'ext_in'   => 'Wajib upload file format .PDF agar bisa divalidasi (TTE).'
                ]
            ]
        ]);

        return redirect()->to('/staf/arsip')->with('success', 'Data berhasil diperbarui!');
    }

    // FUNGSI UNTUK MENGIRIM / MENERUSKAN SURAT
    public function disposisi()
    {
        $id_arsip = $this->request->getPost('id_arsip');
        $tujuan   = $this->request->getPost('tujuan_bagian'); // Ke SDMH / Keuangan
        $catatan  = $this->request->getPost('catatan');
        
        // Ambil Data User yang sedang login
        $user = new \App\Models\UserModel();
        $me   = $user->find(session()->get('id_user'));
        $namaSaya = $me['nama_user'] . " (" . $me['kode_bagian'] . ")";

        // 1. Simpan ke Riwayat (Jejak History)
        $db = \Config\Database::connect();
        $db->table('riwayat_alur')->insert([
            'id_arsip' => $id_arsip,
            'pengirim' => $namaSaya,
            'penerima' => $tujuan,
            'status'   => 'Disposisi / Diteruskan',
            'catatan'  => $catatan,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 2. Update Posisi Surat Sekarang (Dipegang Siapa?)
        $this->arsipModel->update($id_arsip, [
            'lokasi_penyimpanan' => 'Sedang di: ' . $tujuan // Lokasi fisik berubah jadi posisi orang
        ]);

        return redirect()->back()->with('success', 'Surat berhasil diteruskan ke ' . $tujuan);
    }

    // FUNGSI LIHAT DETAIL & HISTORY
    public function detail($id)
    {
        $db = \Config\Database::connect();
        
        $data = [
            'title' => 'Tracking Surat',
            'arsip' => $this->arsipModel->find($id),
            // Ambil data riwayat
            'riwayat' => $db->table('riwayat_alur')
                            ->where('id_arsip', $id)
                            ->orderBy('created_at', 'ASC') // Urut dari awal dibuat
                            ->get()->getResultArray()
        ];
        
        return view('staf/arsip/detail_view', $data);
    }
    // --- FITUR BARU: ACC / TTE SURAT ---
    public function setujui($id)
    {
        // 1. Generate Token Acak (16 karakter aneh)
        $token = bin2hex(random_bytes(16)); 

        // 2. Simpan Token itu ke Database
        $this->arsipModel->update($id, [
            'status' => 'Disetujui',
            'token_validasi' => $token
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditandatangani secara elektronik!');
    }
}