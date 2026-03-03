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
    // Fungsi untuk menampilkan halaman form tambah user
    public function create()
    {
        $data = [
            'title' => 'Add New Staff',
            'validation' => \Config\Services::validation() // Untuk menampilkan error jika salah input
        ];

        return view('admin/user/create_view', $data);
    }

    // Fungsi untuk memproses data dari form dan menyimpan ke Database
    public function save()
    {
        // 1. Aturan Validasi (Cek apakah email sudah dipakai, password sama, dll)
        $rules = [
            'nama_lengkap'     => 'required',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'username'         => 'required|is_unique[users.username]', // Kita jadikan NIP sebagai Username
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
            'role'             => 'required'
        ];

        // Jika validasi gagal, kembalikan ke halaman form beserta pesan error
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new \App\Models\UserModel();

        // 2. Siapkan data yang akan disimpan
        $data = [
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'), // NIP masuk ke sini
            'divisi'        => $this->request->getPost('divisi'),
            'role'          => $this->request->getPost('role'),
            // ENKRIPSI PASSWORD agar aman dan tidak bisa dibaca di phpMyAdmin
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status'        => 'active'
        ];

        // 3. Masukkan ke tabel 'users'
        $userModel->insert($data);

        // 4. Kembali ke halaman User Management dengan pesan sukses
        return redirect()->to(base_url('admin/user'))->with('success', 'New staff member has been registered successfully.');
    }
}