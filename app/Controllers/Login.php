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

        // --- TAMBAHAN UNTUK CEK ERROR (DEBUG) ---
        // Hapus tanda // di bawah ini untuk melihat apa yang ditangkap sistem
        // dd($username_input); 
        // ----------------------------------------

        $user = $model->where('kode_peran', $username_input)->first();

        // --- CEK APAKAH USER KETEMU? ---
        if (!$user) {
            // Kalau masuk sini, berarti query Database GAGAL menemukan NIP
            // Coba lihat apa isi $username_input
            // dd("User tidak ditemukan di DB. Input: " . $username_input);
        
        
        // ... dst kodingan validasi password ... 
            // Cek verifikasi password hash
            if(password_verify($password_input, $user['password_hash'])) {
                
                // 3. SIMPAN SESSION (PENTING: Masukkan kode_bagian)
                $sessionData = [
                    'id_user'     => $user['id_user'], // (sesuaikan nama kolom id di db kamu, id_user/id)
                    'nama_user'   => $user['nama_user'],
                    'role'        => $user['role'],        // Staf / Pimpinan
                    'nip'         => $user['kode_peran'],  // NIP
                    'kode_bagian' => $user['kode_bagian'], // <--- WAJIB ADA (Untuk Disposisi)
                    'isLoggedIn'  => TRUE
                ];
                $session->set($sessionData);

                // Redirect sesuai Role (Opsional, atau lempar semua ke Dashboard)
                // Pimpinan ke Dashboard Pimpinan, Staf ke Dashboard Staf
                if($user['role'] == 'Pimpinan'){
                    return redirect()->to('/pimpinan/dashboard');
                } else {
                    return redirect()->to('/staf/dashboard');
                }

            } else {
                // Password Salah
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            // User Tidak Ditemukan
            $session->setFlashdata('error', 'NIP / Kode Peran tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}