<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Ambil semua data dari tabel user
        $semua_user = $userModel->findAll();

        // Hitung total admin
        $admin_count = 0;
        foreach($semua_user as $u) {
            if($u['role'] == 'admin') {
                $admin_count++;
            }
        }

        $data = [
            'title'       => 'Manajemen Pengguna',
            'users'       => $semua_user,
            'user_aktif'  => count($semua_user),
            'total_admin' => $admin_count
        ];

        return view('admin/user/index_view', $data);
    }

    // Fungsi create & save biarkan seperti yang kamu punya sebelumnya
    public function create()
    {
        $data = ['title' => 'Tambah Pengguna Baru'];
        return view('admin/user/create_view', $data);
    }

    public function save()
    {
        $userModel = new UserModel();
        $userModel->save([
            'kode_peran'    => $this->request->getPost('kode_peran'),
            'nama_user'     => $this->request->getPost('nama_user'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => $this->request->getPost('role'),
            'kode_bagian'   => $this->request->getPost('kode_bagian'),
        ]);
        return redirect()->to('admin/user')->with('success', 'User berhasil ditambahkan');
    }
}