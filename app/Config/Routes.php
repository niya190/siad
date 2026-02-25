<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Menampilkan halaman form login
$routes->get('login', 'Login::index');

// Memproses data yang dikirim dari form login (INI YANG KURANG)
$routes->post('login', 'Login::attemptLogin'); 

// Rute logout yang tadi kita buat
$routes->get('login/logout', 'Login::logout');

// Dashboard Pusat (Redirector berdasarkan role baru)
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// --- GRUP ROUTE ADMIN (Bagian Tata Usaha / IT) ---
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Kelola User Pegawai
    $routes->get('user', 'Admin\UserController::index');
    $routes->get('user/create', 'Admin\UserController::create');
    $routes->post('user/save', 'Admin\UserController::save');

    // Kelola Master Data Kantor
    $routes->get('divisi', 'Admin\DivisiController::index'); 
    $routes->get('jabatan', 'Admin\JabatanController::index');
    $routes->get('jenis-surat', 'Admin\JenisSuratController::index'); 
    $routes->get('gedung', 'Admin\GedungController::index');
    $routes->get('lemari', 'Admin\LemariController::index'); 
    $routes->post('lemari/simpan', 'Admin\LemariController::simpan');

    // === INI BAGIAN YANG KURANG TADI ===
    // ARSIP ADMIN (Search, Create, Edit, Detail)
    $routes->get('arsip/search', 'Admin\ArsipController::search'); // <-- Ini kuncinya biar search jalan!
    $routes->get('arsip/edit/(:num)', 'Admin\ArsipController::edit/$1');
    $routes->get('arsip/detail/(:num)', 'Admin\ArsipController::detail/$1');
    // Rute Form Arsip
    $routes->get('arsip/create', 'Admin\ArsipController::create');
    $routes->post('arsip/save', 'Admin\ArsipController::save');
    
    // Rute AJAX Lokasi Fisik Dinamis
    $routes->post('arsip/getLemari', 'Admin\ArsipController::getLemari');
    $routes->post('arsip/getRak', 'Admin\ArsipController::getRak');
    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings/save', 'Admin\SettingsController::save');
    // ===================================
});
// Ganti bagian STAF yang lama dengan ini:
$routes->group('staf', ['filter' => 'staf'], static function ($routes) {
    $routes->get('dashboard', 'Staf\DashboardController::index'); // Dashboard biarkan
    
    // ARSIP
    $routes->get('arsip', 'Staf\ArsipController::index');
    $routes->get('arsip/create', 'Staf\ArsipController::create');
    $routes->post('arsip/simpan', 'Staf\ArsipController::save');
    $routes->get('arsip/delete/(:num)', 'Staf\ArsipController::delete/$1');
    // Tambahkan di dalam $routes->group('staf' ...
$routes->get('arsip-masuk', 'Staf\ArsipMasukController::index');
$routes->get('arsip-keluar', 'Staf\ArsipKeluarController::index');
$routes->get('nota-dinas', 'Staf\NotaDinasController::index');
$routes->get('laporan', 'Staf\LaporanController::index');
});


// Rute untuk validasi QR (Bisa diakses publik tanpa login)
$routes->get('validasi/cek/(:segment)', 'Validasi::cek/$1');

// Rute untuk tombol setujui (Masuk dalam grup Staf)
$routes->get('staf/arsip/setujui/(:num)', 'Staf\ArsipController::setujui/$1');