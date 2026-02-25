<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    protected $table            = 'master_klasifikasi';
    protected $primaryKey       = 'id_klasifikasi';
    protected $allowedFields    = ['kode_klasifikasi', 'nama_klasifikasi', 'keterangan'];
}