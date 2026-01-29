<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * This happens before the controller is executed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session(); // Ambil service session

        // Cek apakah session 'isLoggedIn' tidak ada atau bernilai FALSE
        if (!$session->get('isLoggedIn')) {
            // Jika belum login, paksa redirect ke halaman login
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        // Jika sudah login, biarkan request berlanjut (return null)
        return;
    }

    /**
     * This happens after the controller is executed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kita tidak perlu melakukan apa-apa di sini
    }
}