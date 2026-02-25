<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $table            = 'master_rak';
    protected $primaryKey       = 'id_rak';
    protected $allowedFields    = ['id_lemari', 'nama_rak', 'keterangan'];
}