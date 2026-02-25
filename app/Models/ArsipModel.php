<?php
namespace App\Models;
use CodeIgniter\Model;

class ArsipModel extends Model
{
    // UBAH DARI 'arsip_surat' MENJADI 'data_arsip'
    protected $table            = 'data_arsip'; 
    protected $primaryKey       = 'id_arsip';
    protected $useAutoIncrement = true;
    
    // Sesuaikan field dengan tabel baru (pakai id_rak, id_klasifikasi)
    protected $allowedFields    = [
        'jenis_arsip', 'id_klasifikasi', 'nomor_surat', 'tanggal_surat', 
        'tanggal_terima', 'pengirim_tujuan', 'perihal', 'id_rak', 
        'keterangan', 'file_scan', 'id_petugas', 'status', 'token_validasi'
    ];
    protected $useTimestamps = true;
    // Fungsi untuk Advanced Search
    public function getAdvancedSearch($filters)
    {
        // 1. Ambil data arsip sekaligus gabungkan (JOIN) dengan tabel lokasi dan klasifikasi
        $builder = $this->select('data_arsip.*, master_klasifikasi.kode_klasifikasi, master_klasifikasi.nama_klasifikasi, master_rak.nama_rak, master_lemari.nama_lemari, master_ruangan.nama_ruangan');
        
        $builder->join('master_klasifikasi', 'master_klasifikasi.id_klasifikasi = data_arsip.id_klasifikasi', 'left');
        $builder->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left');
        $builder->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left');
        $builder->join('master_ruangan', 'master_ruangan.id_ruangan = master_lemari.id_ruangan', 'left');

        // 2. LOGIKA FILTER: Jika user mengisi kotak 'Keyword', cari di Perihal / Keterangan
        if (!empty($filters['keyword'])) {
            $builder->groupStart()
                    ->like('data_arsip.perihal', $filters['keyword'])
                    ->orLike('data_arsip.keterangan', $filters['keyword'])
                    ->groupEnd();
        }
        
        // 3. LOGIKA FILTER: Nomor Surat Kemenhub
        if (!empty($filters['nomor_surat'])) {
            $builder->like('data_arsip.nomor_surat', $filters['nomor_surat']);
        }
        
        // 4. LOGIKA FILTER: Dropdown Klasifikasi
        if (!empty($filters['id_klasifikasi'])) {
            $builder->where('data_arsip.id_klasifikasi', $filters['id_klasifikasi']);
        }
        
        // 5. LOGIKA FILTER: Rentang Tanggal Surat
        if (!empty($filters['start_date'])) {
            $builder->where('data_arsip.tanggal_surat >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $builder->where('data_arsip.tanggal_surat <=', $filters['end_date']);
        }
        
        // 6. LOGIKA FILTER: Dropdown Tahun
        if (!empty($filters['tahun'])) {
            $builder->where('YEAR(data_arsip.tanggal_surat)', $filters['tahun']);
        }
        
        // 7. LOGIKA FILTER: Pengirim atau Tujuan
        if (!empty($filters['pengirim']) || !empty($filters['tujuan'])) {
            $builder->groupStart();
            if(!empty($filters['pengirim'])) $builder->like('data_arsip.pengirim_tujuan', $filters['pengirim']);
            if(!empty($filters['tujuan'])) $builder->orLike('data_arsip.pengirim_tujuan', $filters['tujuan']);
            $builder->groupEnd();
        }
        
        // 8. LOGIKA FILTER: Pencarian Lokasi Fisik Secara Spesifik
        if (!empty($filters['ruangan'])) {
            $builder->like('master_ruangan.nama_ruangan', $filters['ruangan']);
        }
        if (!empty($filters['lemari'])) {
            $builder->like('master_lemari.nama_lemari', $filters['lemari']);
        }
        if (!empty($filters['rak'])) {
            $builder->like('master_rak.nama_rak', $filters['rak']);
        }

        // Urutkan dari arsip yang terbaru di-input
        return $builder->orderBy('data_arsip.tanggal_terima', 'DESC');
    }
}