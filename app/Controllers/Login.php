<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    // =====================================
    // MENAMPILKAN HALAMAN LOGIN
    // =====================================
    public function index()
    {
        // Cek jika sudah login, arahkan ke dashboard yang sesuai
        if (session()->get('isLoggedIn')) {
            return session()->get('role') === 'admin' 
                ? redirect()->to('/admin/dashboard') 
                : redirect()->to('/staf/dashboard');
        }

        return view('login');
    }

    // =====================================
    // PROSES OTENTIKASI LOGIN
    // =====================================
    public function auth()
    {
        $session = session();
        $userModel = new UserModel();
        
        // Ambil inputan dari form
        $login_id = $this->request->getPost('login_id'); // Bisa NIP, Username, atau Email
        $password = $this->request->getPost('password');
        
        // 1. Cari user berdasarkan NIP, Username, ATAU Email
        $user = $userModel->groupStart()
                          ->where('nip', $login_id)
                          ->orWhere('username', $login_id)
                          ->orWhere('email', $login_id)
                          ->groupEnd()
                          ->first();
                          
        if ($user) {
            // 2. Cek apakah akun ditangguhkan (Suspended)
            if ($user['status'] === 'suspended') {
                return redirect()->back()->with('error', 'Akun Anda ditangguhkan! Silakan hubungi Administrator.');
            }

            // 3. Verifikasi Password (Mendukung Hash BCRYPT dan teks biasa)
            if (password_verify($password, $user['password_hash']) || $password == $user['password_hash']) {
                
                // 4. Update waktu login terakhir
                $userModel->update($user['id_user'], [
                    'last_login' => date('Y-m-d H:i:s')
                ]);

                // 5. Simpan data ke Session
                $session->set([
                    'id_user'      => $user['id_user'],
                    'nip'          => $user['nip'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'email'        => $user['email'],
                    'role'         => $user['role'],
                    'isLoggedIn'   => TRUE
                ]);
                
                // 6. Arahkan ke Dashboard
                return $user['role'] === 'admin' 
                    ? redirect()->to('/admin/dashboard') 
                    : redirect()->to('/staf/dashboard');

            } else {
                return redirect()->back()->with('error', 'Password yang Anda masukkan salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Akun tidak ditemukan. Periksa kembali NIP, Username, atau Email Anda.');
        }
    }

    // =====================================
    // HALAMAN FORGOT PASSWORD
    // =====================================
    public function forgotPassword()
    {
        return view('forgot_password');
    }

    // =====================================
    // PROSES FORGOT PASSWORD
    // =====================================
    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        
        // Cari user berdasarkan email
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Logika idealnya: Generate token unik, simpan ke database, lalu kirim email.
            // Di sini kita gunakan simulasi pesan sukses karena ini lingkungan lokal (development)
            return redirect()->to('/')->with('success', 'Instruksi pemulihan password telah dikirim ke ' . $email . '. (SIMULASI: Hubungi Admin untuk reset manual)');
        } else {
            return redirect()->back()->with('error', 'Alamat email tidak terdaftar di sistem kami.');
        }
    }

    // =====================================
    // PROSES LOGOUT
    // =====================================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}