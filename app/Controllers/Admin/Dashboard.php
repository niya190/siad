<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ArsipModel;
use App\Models\LemariModel; // <-- Tambahkan ini

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $arsipModel = new ArsipModel();
        $lemariModel = new LemariModel(); // <-- Panggil model lemari
        
        $data = [
            'title'          => 'Dashboard Admin',
            'users'          => $userModel->findAll(), 
            'total_arsip'    => $arsipModel->countAllResults(),
            // --- KIRIM DATA LEMARI KE VIEW ---
            'daftar_lemari'  => $lemariModel->findAll() 
        ];

        return view('admin/dashboard_view', $data);
    }
}