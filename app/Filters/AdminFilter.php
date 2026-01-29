<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // 2. Cek apakah role-nya BUKAN admin
        if ($session->get('role') !== 'admin') {
            // Jika bukan admin, tendang dia kembali ke dashboard-nya sendiri
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}