<?php
namespace App\Models;
use CodeIgniter\Model;

class GedungModel extends Model {
    protected $table = 'master_gedung';
    protected $primaryKey = 'id_gedung';
    protected $allowedFields = ['nama_gedung', 'alamat', 'jumlah_lantai', 'foto_url'];
}