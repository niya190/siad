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
        $user = $model->where('kode_peran', $username_input)->first();

        // LOGIKA YANG BENAR: Jika User DITEMUKAN ($user ada isinya)
        if ($user) {
            
            // Bypass Password (Anggap selalu benar, sesuai request kamu sebelumnya)
            // Kalau mau normal, ganti jadi: if(password_verify($password_input, $user['password_hash']))
            $password_benar = true; 

            if ($password_benar) {
                // Simpan Session
                $sessionData = [
                    'id_user'     => $user['id_user'],
                    'nama_user'   => $user['nama_user'],
                    'role'        => $user['role'],
                    'nip'         => $user['kode_peran'],
                    'kode_bagian' => $user['kode_bagian'],
                    'isLoggedIn'  => TRUE
                ];
                $session->set($sessionData);

                // Redirect
                if($user['role'] == 'Pimpinan'){
                    return redirect()->to('/pimpinan/dashboard');
                } else {
                    return redirect()->to('/staf/dashboard');
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
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}