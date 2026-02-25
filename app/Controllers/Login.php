<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Jika sudah login, langsung lempar ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('login');
    }

   public function attemptLogin()
    {
        $session = session();
        $model = new UserModel();

        $username_input = $this->request->getPost('username');
        $password_input = $this->request->getPost('password');

        // Cari User
        $user = $model->where('username', $username_input)
              ->orWhere('email', $username_input)
              ->first();

        // LOGIKA YANG BENAR: Jika User DITEMUKAN ($user ada isinya)
        if ($user) {
            
            // Bypass Password (Anggap selalu benar, sesuai request kamu sebelumnya)
            // Kalau mau normal, ganti jadi: if(password_verify($password_input, $user['password_hash']))
            $password_benar = true; 

   // Jika login berhasil
if ($password_benar) {
    $sessionData = [
        'id_user'      => $user['id_user'],
        'username'     => $user['username'],
        'nama_lengkap' => $user['nama_lengkap'],
        'role'         => $user['role'],
        'divisi'       => $user['divisi'],
        'isLoggedIn'   => TRUE
    ];
    $session->set($sessionData);
    
    // Redirect sesuai role (hanya Admin & Staff)
    // Redirect sesuai role
    if ($user['role'] == 'admin') {
        return redirect()->to(base_url('admin/dashboard'));
    } else {
        // PASTIKAN TULISANNYA 'staf/dashboard', bukan cuma 'dashboard'
        return redirect()->to(base_url('staf/dashboard')); 
    }
}
        } else {
            // Jika User TIDAK DITEMUKAN
            $session->setFlashdata('error', 'NIP / Kode Peran tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Menghapus semua data session (mengeluarkan user)
        session()->destroy();
        
        // Mengarahkan kembali ke halaman login
        return redirect()->to(base_url('login'))->with('success', 'Anda telah berhasil logout.');
    }
}