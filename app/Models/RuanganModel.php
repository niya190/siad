<?php
namespace App\Models;
use CodeIgniter\Model;

class RuanganModel extends Model {
    protected $table = 'master_ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $allowedFields = ['id_gedung', 'nama_ruangan', 'tipe_ruangan', 'lantai', 'kapasitas', 'status_ruangan'];
}