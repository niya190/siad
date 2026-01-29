<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\NotaDinasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Kita hitung-hitungan sederhana untuk dashboard
        $data = [
            'title' => 'Dashboard Admin',
            'total_user' => $userModel->countAll(),
            'total_staf' => $userModel->where('role', 'staf')->countAllResults(),
            'total_pimpinan' => $userModel->where('role', 'pimpinan')->countAllResults(),
        ];

        return view('admin/dashboard_view', $data);
    }
}