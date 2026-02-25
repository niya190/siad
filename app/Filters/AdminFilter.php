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
       // KODE BARU - Lebih aman
if (session()->get('role') !== 'admin') {
    // Cek role-nya apa, baru lempar ke dashboard masing-masing
    if (session()->get('role') === 'staff') {
        return redirect()->to(base_url('staf/dashboard'));
    }
    // Jika ada pimpinan nanti:
    // elseif (session()->get('role') === 'pimpinan') { return redirect()->to(base_url('pimpinan/dashboard')); }
    
    // Default fallback biar gak looping
    return redirect()->to('/'); 
}
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}