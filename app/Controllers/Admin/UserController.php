<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $keyword = $this->request->getGet('keyword');

        // 1. Logika Pencarian
        if ($keyword) {
            $userModel->search($keyword);
        }

        // 2. Ambil Data dengan Pagination
        $users = $userModel->orderBy('last_login', 'DESC')->paginate(10, 'users');
        $pager = $userModel->pager;

        // 3. Hitung Statistik untuk Kartu Atas
        // Kita buat instance baru/query terpisah agar tidak terganggu filter search
        $statsModel = new UserModel(); 
        $totalUsers = $statsModel->countAllResults();
        $totalAdmins = $statsModel->where('role', 'admin')->countAllResults();
        $totalActive = $statsModel->where('status', 'active')->countAllResults();

        $data = [
            'title'       => 'User Management',
            'users'       => $users,
            'pager'       => $pager,
            'keyword'     => $keyword,
            'total_users' => $totalUsers,
            'total_admins'=> $totalAdmins,
            'total_active'=> $totalActive
        ];

        return view('admin/user/index_view', $data);
    }
}