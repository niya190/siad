<?php

namespace App\Controllers\Pimpinan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Data dummy dulu biar halaman tampil
        $data = [
            'title' => 'Dashboard Pimpinan',
            'surat_masuk' => 0,
            'acc_bulan_ini' => 0
        ];

        return view('pimpinan/dashboard_view', $data);
    }
}