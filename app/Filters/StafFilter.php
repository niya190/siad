<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class StafFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah sudah login
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // 2. Cek apakah role-nya BENAR-BENAR 'staf'
        if (session()->get('role') !== 'staf') {
            // Jika bukan staf (misal admin iseng masuk link staf), tendang ke dashboard dia sendiri
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}