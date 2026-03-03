<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LemariController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $data = [
            'title'   => 'Manajemen Lokasi Penyimpanan',
            'gedung'  => $db->table('master_gedung')->get()->getResultArray(),
            'ruangan' => $db->table('master_ruangan')
                            ->join('master_gedung', 'master_gedung.id_gedung = master_ruangan.id_gedung', 'left')
                            ->get()->getResultArray(),
            'lemari'  => $db->table('master_lemari')
                            ->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left')
                            ->get()->getResultArray(),
            'rak'     => $db->table('master_rak')
                            ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
                            ->get()->getResultArray()
        ];

        return view('admin/lemari/index_view', $data);
    }

    // ==========================================
    // FUNGSI SIMPAN (CREATE)
    // ==========================================
    public function simpanGedung()
    {
        $db = \Config\Database::connect();
        $db->table('master_gedung')->insert([
            'nama_gedung'   => $this->request->getPost('nama_gedung'),
            'alamat'        => 'Belum diatur',
            'jumlah_lantai' => 1
        ]);
        return redirect()->back()->with('success', 'Gedung baru berhasil ditambahkan!');
    }

    public function simpanRuangan()
    {
        $db = \Config\Database::connect();
        $db->table('master_ruangan')->insert([
            'id_gedung'      => $this->request->getPost('id_gedung'),
            'nama_ruangan'   => $this->request->getPost('nama_ruangan'),
            'tipe_ruangan'   => 'Ruang Penyimpanan',
            'lantai'         => 'Lantai 1',
            'kapasitas'      => 100
        ]);
        return redirect()->back()->with('success', 'Ruangan baru berhasil ditambahkan!');
    }

    public function simpanLemari()
    {
        $db = \Config\Database::connect();
        $db->table('master_lemari')->insert([
            'id_ruangan'         => $this->request->getPost('id_ruangan'),
            'nama_lemari'        => $this->request->getPost('nama_lemari'),
            'lokasi_ruangan'     => 'Dalam Ruangan',
            'kapasitas_maksimal' => 200
        ]);
        return redirect()->back()->with('success', 'Lemari baru berhasil ditambahkan!');
    }

    public function simpanRak()
    {
        $db = \Config\Database::connect();
        $db->table('master_rak')->insert([
            'id_lemari' => $this->request->getPost('id_lemari'),
            'nama_rak'  => $this->request->getPost('nama_rak')
        ]);
        return redirect()->back()->with('success', 'Rak/Box baru berhasil ditambahkan!');
    }

    // ==========================================
    // FUNGSI UPDATE (UBAH NAMA)
    // ==========================================
    public function updateGedung($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_gedung')->where('id_gedung', $id)->update(['nama_gedung' => $this->request->getPost('nama_baru')]);
        return redirect()->back()->with('success', 'Nama gedung berhasil diubah!');
    }

    public function updateRuangan($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_ruangan')->where('id_ruangan', $id)->update(['nama_ruangan' => $this->request->getPost('nama_baru')]);
        return redirect()->back()->with('success', 'Nama ruangan berhasil diubah!');
    }

    public function updateLemari($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_lemari')->where('id_lemari', $id)->update(['nama_lemari' => $this->request->getPost('nama_baru')]);
        return redirect()->back()->with('success', 'Nama lemari berhasil diubah!');
    }

    public function updateRak($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_rak')->where('id_rak', $id)->update(['nama_rak' => $this->request->getPost('nama_baru')]);
        return redirect()->back()->with('success', 'Nama rak/box berhasil diubah!');
    }

    // ==========================================
    // FUNGSI HAPUS (DELETE)
    // ==========================================
    public function hapusGedung($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_gedung')->where('id_gedung', $id)->delete();
        return redirect()->back()->with('success', 'Gedung berhasil dihapus!');
    }

    public function hapusRuangan($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_ruangan')->where('id_ruangan', $id)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus!');
    }

    public function hapusLemari($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_lemari')->where('id_lemari', $id)->delete();
        return redirect()->back()->with('success', 'Lemari berhasil dihapus!');
    }

    public function hapusRak($id)
    {
        $db = \Config\Database::connect();
        $db->table('master_rak')->where('id_rak', $id)->delete();
        return redirect()->back()->with('success', 'Rak/Box berhasil dihapus!');
    }
}