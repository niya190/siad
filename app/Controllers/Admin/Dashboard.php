<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ArsipModel; // <-- KITA GANTI JADI ARSIP MODEL

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $arsipModel = new ArsipModel(); // <-- KITA GANTI DI SINI JUGA
        
        $data = [
            'title'          => 'Dashboard Admin',
            'total_user'     => $userModel->countAll(),
            'total_staf'     => $userModel->where('role', 'staf')->countAllResults(),
            'total_pimpinan' => $userModel->where('role', 'pimpinan')->countAllResults(),
            
            // Data untuk tampilan Tailwind
            'users'          => $userModel->findAll(), 
            'total_arsip'    => $arsipModel->countAllResults(), // <-- AMBIL DARI ARSIP MODEL
        ];

        return view('admin/dashboard_view', $data);
    }
}