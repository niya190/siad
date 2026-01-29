<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PimpinanFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek Login
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // 2. Cek Role PIMPINAN
        if (session()->get('role') !== 'pimpinan') {
            // Kalau bukan pimpinan, tendang ke dashboard masing-masing
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}