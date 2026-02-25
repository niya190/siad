<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function index()
    {
        // Dalam implementasi nyata, data ini bisa diambil dari database tabel 'settings'
        // atau file .env. Untuk sekarang, kita gunakan data dummy yang merepresentasikan
        // kondisi sistem saat ini.
        $data = [
            'title' => 'System Settings',
            // Contoh data statis untuk mengisi form
            'office_name' => 'Distrik Navigasi Tanjungpinang',
            'classification' => 'Tipe A Kelas I',
            'address' => 'Jl. Kijang Lama No.12, Tanjungpinang Timur, Kepulauan Riau, Indonesia',
            'email' => 'admin@disnavtanjungpinang.go.id',
            'phone' => '+62 771 1234567',
        ];

        return view('admin/settings/index_view', $data);
    }

    public function save()
    {
        // Di sini kamu akan menangani proses penyimpanan data ke database atau file config.
        // Contoh sederhana:
        $officeName = $this->request->getPost('office_name');
        $classification = $this->request->getPost('classification');
        $address = $this->request->getPost('address');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        
        // ... (Logika penyimpanan data) ...

        // Redirect kembali ke halaman settings dengan pesan sukses
        return redirect()->to(base_url('admin/settings'))->with('success', 'Settings updated successfully.');
    }
}