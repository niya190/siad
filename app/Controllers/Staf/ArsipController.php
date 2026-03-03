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

    // =======================================================
    // MENAMPILKAN FORM TAMBAH ARSIP
    // =======================================================
    public function create()
    {
        $klasifikasiModel = new \App\Models\KlasifikasiModel();
        $gedungModel = new \App\Models\GedungModel(); // Panggil GedungModel

        $data = [
            'title'       => 'Tambah Arsip Baru',
            'klasifikasi' => $klasifikasiModel->findAll(),
            'gedung'      => $gedungModel->findAll() // Kirim data gedung ke form
        ];

        return view('staf/arsip/create_view', $data);
    }

    // =======================================================
    // FUNGSI AJAX DROPDOWN DINAMIS (GEDUNG -> RUANGAN -> LEMARI -> RAK)
    // =======================================================
    public function getRuangan()
    {
        if ($this->request->isAJAX()) {
            $id_gedung = $this->request->getPost('id_gedung');
            $ruanganModel = new \App\Models\RuanganModel();
            
            // Ambil data ruangan yang HANYA ada di gedung yang dipilih
            $data = $ruanganModel->where('id_gedung', $id_gedung)->findAll();
            return $this->response->setJSON($data);
        }
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
    // =========================================================
    // TAMBAHKAN KODE INI DI BAWAH FUNGSI detail()
    // =========================================================

    // =======================================================
    // MENAMPILKAN FORM EDIT DENGAN DATA LAMA & LOKASI
    // =======================================================
    public function edit($id)
    {
        $arsipModel = new \App\Models\ArsipModel();
        $arsip = $arsipModel->find($id);

        if (!$arsip) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $klasifikasiModel = new \App\Models\KlasifikasiModel();
        $ruanganModel = new \App\Models\RuanganModel();
        $lemariModel = new \App\Models\LemariModel();
        $rakModel = new \App\Models\RakModel();

        // Cari tahu Ruangan dan Lemari mana dari id_rak yang tersimpan
        $id_rak_tersimpan = $arsip['id_rak'];
        $rakTersimpan = $rakModel->find($id_rak_tersimpan);
        $id_lemari_tersimpan = $rakTersimpan ? $rakTersimpan['id_lemari'] : '';
        
        $lemariTersimpan = $id_lemari_tersimpan ? $lemariModel->find($id_lemari_tersimpan) : null;
        $id_ruangan_tersimpan = $lemariTersimpan ? $lemariTersimpan['id_ruangan'] : '';

        $data = [
            'title'       => 'Edit Arsip',
            'arsip'       => $arsip,
            'klasifikasi' => $klasifikasiModel->findAll(),
            'ruangan'     => $ruanganModel->findAll(),
            
            // Kirim data ID relasi ke view agar Javascript bisa me-load data lama
            'id_ruangan_tersimpan' => $id_ruangan_tersimpan,
            'id_lemari_tersimpan'  => $id_lemari_tersimpan,
            'id_rak_tersimpan'     => $id_rak_tersimpan
        ];

        return view('staf/arsip/edit_view', $data);
    }

    // =======================================================
    // MENYIMPAN PERUBAHAN DATA
    // =======================================================
    public function update($id)
    {
        $arsipModel = new \App\Models\ArsipModel();
        $arsipLama = $arsipModel->find($id);

        if (!$arsipLama) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'jenis_arsip'      => $this->request->getPost('jenis_arsip'),
            'id_klasifikasi'   => $this->request->getPost('id_klasifikasi') ?: null,
            'id_rak'           => $this->request->getPost('id_rak'), // <-- INI YANG BARU DITAMBAHKAN
            'nomor_surat'      => $this->request->getPost('nomor_surat'),
            'tanggal_surat'    => $this->request->getPost('tanggal_surat'),
            'tanggal_terima'   => $this->request->getPost('tanggal_terima'),
            'pengirim_tujuan'  => $this->request->getPost('pengirim_tujuan'),
            'perihal'          => $this->request->getPost('perihal'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ];

        // Cek apakah user meng-upload file PDF baru
        $file = $this->request->getFile('file_scan');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move(FCPATH . 'uploads/arsip', $namaFile);
            $data['file_scan'] = $namaFile;

            // Hapus PDF lama
            if (!empty($arsipLama['file_scan']) && file_exists(FCPATH . 'uploads/arsip/' . $arsipLama['file_scan'])) {
                unlink(FCPATH . 'uploads/arsip/' . $arsipLama['file_scan']);
            }
        }

        $arsipModel->update($id, $data);
        return redirect()->to(base_url('staf/arsip/detail/' . $id))->with('success', 'Data arsip berhasil diperbarui!');
    }
    public function save()
    {
        // Nanti di sini isi logika untuk insert ke database
        // Sementara kita buat kembali ke dashboard biar gak error 404
        return redirect()->to(base_url('staf/dashboard'));
    }

   
    // Logika untuk menangkap dan menyimpan perubahan Edit Data
    
    // =======================================================
    // 1. FUNGSI HAPUS ARSIP & FILE PDF
    // =======================================================
            public function delete($id)
    {
        $arsipModel = new \App\Models\ArsipModel();
        $arsip = $arsipModel->find($id);

        if ($arsip) {
            // Cek apakah ada file fisik PDF, jika ada hapus dari folder agar server tidak penuh
            if (!empty($arsip['file_scan']) && file_exists(FCPATH . 'uploads/arsip/' . $arsip['file_scan'])) {
                unlink(FCPATH . 'uploads/arsip/' . $arsip['file_scan']);
            }
            
            // Hapus baris data dari database
            $arsipModel->delete($id);
            return redirect()->back()->with('success', 'Data arsip dan file lampiran berhasil dihapus secara permanen!');
        }

        return redirect()->back()->with('error', 'Data arsip tidak ditemukan.');
    }

    // =======================================================
    // 2. FUNGSI AJAX UNTUK DROPDOWN DINAMIS (RUANGAN -> LEMARI -> RAK)
    // =======================================================
    public function getLemari()
    {
        if ($this->request->isAJAX()) {
            $id_ruangan = $this->request->getPost('id_ruangan');
            $lemariModel = new \App\Models\LemariModel();
            
            // Ambil data lemari yang HANYA ada di ruangan yang dipilih
            $data = $lemariModel->where('id_ruangan', $id_ruangan)->findAll();
            return $this->response->setJSON($data);
        }
    }

    public function getRak()
    {
        if ($this->request->isAJAX()) {
            $id_lemari = $this->request->getPost('id_lemari');
            $rakModel = new \App\Models\RakModel();
            
            // Ambil data rak yang HANYA ada di lemari yang dipilih
            $data = $rakModel->where('id_lemari', $id_lemari)->findAll();
            return $this->response->setJSON($data);
        }
    }
}