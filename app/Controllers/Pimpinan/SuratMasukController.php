<?php

namespace App\Controllers\Pimpinan;

use App\Controllers\BaseController;
use App\Models\NotaDinasModel;

class SuratMasukController extends BaseController
{
    protected $notaModel;

    public function __construct() {
        $this->notaModel = new NotaDinasModel();
    }

    public function index() {
        $data = [
            'title' => 'Surat Masuk (Pending)',
            'surat_masuk' => $this->notaModel->getNotaMasuk()
        ];
        return view('pimpinan/surat_masuk/index_view', $data);
    }

    public function detail($id) {
        $data = [
            'title' => 'Detail Nota',
            'nota' => $this->notaModel->find($id)
        ];
        return view('pimpinan/surat_masuk/detail_view', $data);
    }

    // --- LOGIKA ACC DENGAN REFERENSI EXCEL ---
    // --- UPDATE FUNGSI APPROVE YANG LEBIH AMAN ---
    public function approve() {
        $id = $this->request->getPost('id_nota');
        $nota = $this->notaModel->find($id);
        
        // Pengaman: Jika jenis surat kosong (data lama), anggap Surat Keluar biasa
        $jenis = $nota['jenis_surat'] ?? 'Surat Keluar'; 

        // 1. Tentukan Prefix Kode & Lokasi (Sesuai Excel)
        $kodePrefix = 'UM'; 
        $lokasi = 'Gudang Arsip';

        switch ($jenis) {
            case 'Surat Masuk':
                $kodePrefix = 'UM.002'; 
                $lokasi = 'Lemari A - Rak 1'; 
                break;
            case 'Surat Keluar':
                $kodePrefix = 'PL.101'; 
                $lokasi = 'Lemari A - Rak 2'; 
                break;
            case 'SK':
                $kodePrefix = 'KN.AND'; 
                $lokasi = 'Lemari B - Box 1'; 
                break;
            case 'Berkas Proyek':
                $kodePrefix = 'PRJ';
                $lokasi = 'Gudang Arsip';
                break;
            default: // Default jika tidak terdeteksi
                $kodePrefix = 'UM';
                $lokasi = 'Rak Umum';
                break;
        }

        // 2. Generate Nomor: [KODE]/[NO_URUT]/NV-[TAHUN]
        $noUrut = rand(100, 999);
        $tahunDuaDigit = date('y');
        $nomorJadi = sprintf("%s/%s/NV-%s", $kodePrefix, $noUrut, $tahunDuaDigit);

        // 3. Simpan ke Database
        $this->notaModel->update($id, [
            'status' => 'Disetujui',
            'nomor_nota' => $nomorJadi,
            'lokasi_arsip' => $lokasi,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/pimpinan/arsip')->with('success', "Disetujui. No: $nomorJadi. Lokasi: $lokasi");
    }

    public function arsip() {
        // ... kode arsip sama seperti sebelumnya ...
        $keyword = $this->request->getGet('q');
        $data = [
            'title' => 'Arsip & Lokasi Penyimpanan',
            'keyword' => $keyword,
            'arsip' => $this->notaModel->cariArsip($keyword)
        ];
        return view('pimpinan/arsip_view', $data);
    }
    public function revisi() {
        $id = $this->request->getPost('id_nota');
        $catatan = $this->request->getPost('catatan_revisi');

        $this->notaModel->update($id, [
            'status' => 'Revisi',
            'catatan_revisi' => $catatan,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/pimpinan/surat-masuk')->with('success', 'Nota dikembalikan untuk revisi.');
    }

    // ... method lainnya ...

    // TAMBAHAN: Fitur Cetak PDF untuk Pimpinan
    public function exportPDF($id)
    {
        $nota = $this->notaModel->find($id);
        
        // Cek data
        if (!$nota) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Panggil Model User untuk ambil nama pembuat
        $userModel = new \App\Models\UserModel();
        
        $data = [
            'nota' => $nota,
            'pembuat' => $userModel->find($nota['id_pembuat'])
        ];

        // Generate PDF
        $dompdf = new \Dompdf\Dompdf();
        // Kita pakai view yang sama dengan staf agar hemat kode
        $dompdf->loadHtml(view('staf/nota_dinas/print_view', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        // Download / Preview
        $dompdf->stream("Arsip_Nota_".$nota['nomor_nota'].".pdf", ["Attachment" => 0]);
    }
} // <--- Tutup Class
