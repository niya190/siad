<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        // Arahkan sesuai jabatan di Kantor Navigasi
        if ($role === 'admin') {
            return redirect()->to('admin/dashboard');
        } elseif ($role === 'staf') {
            return redirect()->to('staf/dashboard');
        } elseif ($role === 'pimpinan') {
            return redirect()->to('pimpinan/dashboard');
        } else {
            // Jika tidak punya role jelas, tendang keluar
            return redirect()->to('login');
        }
    }
}