<?php
namespace App\Models;
use CodeIgniter\Model;

class LemariModel extends Model
{
    protected $table            = 'master_lemari';
    protected $primaryKey       = 'id_lemari';
    // Tambahkan jumlah_rak dan kapasitas_per_rak
    protected $allowedFields    = ['nama_lemari', 'lokasi_ruangan', 'jumlah_rak', 'kapasitas_per_rak', 'kapasitas_maksimal', 'jumlah_terisi'];
}