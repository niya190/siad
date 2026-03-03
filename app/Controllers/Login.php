<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    // =====================================
    // HALAMAN LOGIN
    // =====================================
    public function index()
    {
        // Jika sudah login, langsung tendang ke dashboard masing-masing
        if (session()->get('logged_in')) {
            return session()->get('role') === 'admin' ? redirect()->to('/admin/dashboard') : redirect()->to('/staf/dashboard');
        }
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $userModel = new UserModel();
        
        $login_id = $this->request->getPost('login_id'); // Bisa NIP, Username, atau Email
        $password = $this->request->getPost('password');
        
        // Cari user berdasarkan Username ATAU Email ATAU NIP
        $user = $userModel->groupStart()
                          ->where('username', $login_id)
                          ->orWhere('email', $login_id)
                          ->orWhere('nip', $login_id)
                          ->groupEnd()
                          ->first();
                          
        if ($user) {
            if ($user['status'] == 'suspended') {
                return redirect()->to('/')->with('error', 'Akun Anda ditangguhkan! Hubungi Admin.');
            }

            // Cek Password (Bisa baca Hash BCRYPT ataupun teks biasa bawaan dummy lama)
            if (password_verify($password, $user['password_hash']) || $password == $user['password_hash']) {
                $session->set([
                    'id_user'      => $user['id_user'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'role'         => $user['role'],
                    'logged_in'    => TRUE
                ]);
                
                return $user['role'] === 'admin' ? redirect()->to('/admin/dashboard') : redirect()->to('/staf/dashboard');
            } else {
                return redirect()->to('/')->with('error', 'Password yang Anda masukkan salah.');
            }
        } else {
            return redirect()->to('/')->with('error', 'Akun tidak ditemukan. Silakan daftar terlebih dahulu.');
        }
    }

    // =====================================
    // HALAMAN REGISTER
    // =====================================
    public function register()
    {
        return view('register');
    }

    public function registerProcess()
    {
        $userModel = new UserModel();

        // Validasi agar Username, Email, atau NIP tidak kembar
        $cek = $userModel->where('username', $this->request->getPost('username'))
                         ->orWhere('email', $this->request->getPost('email'))
                         ->orWhere('nip', $this->request->getPost('nip'))->first();
                         
        if ($cek) return redirect()->back()->with('error', 'NIP, Username, atau Email sudah terdaftar!');

        $userModel->save([
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'nip'           => $this->request->getPost('nip'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'          => 'staff', // Default yang mendaftar adalah staff
            'status'        => 'active'
        ]);

        return redirect()->to('/')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // =====================================
    // HALAMAN FORGOT PASSWORD
    // =====================================
    public function forgotPassword()
    {
        return view('forgot_password');
    }

    public function forgotPasswordProcess()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        
        if ($userModel->where('email', $email)->first()) {
            // Simulasi Pengiriman Email (karena di localhost biasanya belum setting SMTP)
            return redirect()->to('/')->with('success', 'Instruksi reset password telah dikirim ke email: ' . $email . ' (Simulasi)');
        } else {
            return redirect()->back()->with('error', 'Email tidak terdaftar di sistem kami.');
        }
    }

    // =====================================
    // LOGOUT
    // =====================================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}