<?php

namespace App\Models;

use CodeIgniter\Model;

class GedungModel extends Model
{
    protected $table            = 'master_gedung';
    protected $primaryKey       = 'id_gedung';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_gedung', 'alamat', 'jumlah_lantai', 'foto_url'];
}