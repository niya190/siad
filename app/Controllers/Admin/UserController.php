<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // 1. Tampilkan List User
    public function index()
    {
        $data = [
            'title' => 'Manajemen Pegawai',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/user/index_view', $data);
    }

    // 2. Form Tambah User
    public function create()
    {
        $data = ['title' => 'Tambah Pegawai Baru'];
        return view('admin/user/create_view', $data);
    }

    // 3. Simpan User Baru
    public function save()
    {
        // Hash password default '123456' biar gampang, nanti user suruh ganti sendiri
        $password = password_hash('123456', PASSWORD_DEFAULT);

        $this->userModel->save([
            'nama_user' => $this->request->getPost('nama_user'),
            'password_hash' => $password,
            'role' => $this->request->getPost('role'),
            'kode_peran' => $this->request->getPost('nip'), // Simpan NIP ke kode_peran
        ]);

        return redirect()->to('/admin/user')->with('success', 'Pegawai berhasil ditambahkan! Password default: 123456');
    }

    // 4. Form Edit User
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pegawai',
            'user'  => $this->userModel->find($id)
        ];
        return view('admin/user/edit_view', $data);
    }

    // 5. Update Data User
    public function update($id)
    {
        $data = [
            'id_user' => $id,
            'nama_user' => $this->request->getPost('nama_user'),
            'role' => $this->request->getPost('role'),
            'kode_peran' => $this->request->getPost('nip'),
        ];

        // Cek kalau admin input password baru (Reset Password)
        $passwordBaru = $this->request->getPost('password');
        if (!empty($passwordBaru)) {
            $data['password_hash'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $this->userModel->save($data);
        return redirect()->to('/admin/user')->with('success', 'Data pegawai berhasil diupdate.');
    }

    // 6. Hapus User
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('success', 'Pegawai telah dihapus.');
    }
}