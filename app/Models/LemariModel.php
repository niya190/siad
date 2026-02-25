<?php

namespace App\Models;

use CodeIgniter\Model;

class LemariModel extends Model
{
    protected $table            = 'master_lemari';
    protected $primaryKey       = 'id_lemari';
    protected $allowedFields    = ['id_ruangan', 'nama_lemari', 'keterangan'];
}