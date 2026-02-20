<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $table            = 'arsip_surat';
    protected $primaryKey       = 'id_arsip';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tanggal_terima', 'jenis_arsip', 'nomor_surat', 
        'tanggal_surat', 'pengirim_tujuan', 'perihal', 
        'lokasi_penyimpanan', 'keterangan', 'file_scan', 
        'id_petugas', 'created_at', 'updated_at', 'status', 'token_validasi' // <--- TAMBAHKAN DUA INI
    ];
    protected $useTimestamps = true;

    // Fitur Pencarian Canggih (Berdasarkan Nomor, Perihal, atau Jenis)
    public function cariData($keyword = null, $jenis = null)
    {
        $builder = $this->table($this->table);
        $builder->select('arsip_surat.*, user.nama_user as petugas');
        $builder->join('user', 'user.id_user = arsip_surat.id_petugas', 'left');

        if ($keyword) {
            $builder->groupStart()
                    ->like('nomor_surat', $keyword)
                    ->orLike('perihal', $keyword)
                    ->orLike('pengirim_tujuan', $keyword)
                    ->groupEnd();
        }
        
        if ($jenis) {
            $builder->where('jenis_arsip', $jenis);
        }

        return $builder->orderBy('created_at', 'DESC')->findAll();
    }
}