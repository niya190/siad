<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Login (Tetap sama)
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::attemptLogin');
$routes->get('/logout', 'Login::logout');

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
    $routes->get('arsip/create', 'Admin\ArsipController::create');
    $routes->get('arsip/edit/(:num)', 'Admin\ArsipController::edit/$1');
    $routes->get('arsip/detail/(:num)', 'Admin\ArsipController::detail/$1');
    // ===================================
});
// Ganti bagian STAF yang lama dengan ini:
$routes->group('staf', ['filter' => 'staf'], static function ($routes) {
    $routes->get('dashboard', 'Staf\Dashboard::index'); // Dashboard biarkan
    
    // ARSIP
    $routes->get('arsip', 'Staf\ArsipController::index');
    $routes->get('arsip/create', 'Staf\ArsipController::create');
    $routes->post('arsip/simpan', 'Staf\ArsipController::save');
    $routes->get('arsip/delete/(:num)', 'Staf\ArsipController::delete/$1');
    // Tambahkan di dalam $routes->group('staf' ...
$routes->get('arsip/cetak/(:num)', 'Staf\ArsipController::exportPDF/$1');
// Tambahkan di grup Staf
$routes->get('arsip/edit/(:num)', 'Staf\ArsipController::edit/$1');
$routes->post('arsip/update/(:num)', 'Staf\ArsipController::update/$1');
$routes->get('arsip/detail/(:num)', 'Staf\ArsipController::detail/$1');
$routes->post('arsip/disposisi', 'Staf\ArsipController::disposisi');
});

// GRUP PIMPINAN
$routes->group('pimpinan', ['filter' => 'pimpinan'], static function ($routes) {
    $routes->get('dashboard', 'Pimpinan\Dashboard::index');
    
    // Approval
    $routes->get('surat-masuk', 'Pimpinan\SuratMasukController::index');
    $routes->get('surat-masuk/detail/(:num)', 'Pimpinan\SuratMasukController::detail/$1');
    $routes->post('surat-masuk/approve', 'Pimpinan\SuratMasukController::approve');
    $routes->post('surat-masuk/revisi', 'Pimpinan\SuratMasukController::revisi');
    $routes->get('arsip', 'Pimpinan\SuratMasukController::arsip'); 
    $routes->get('pdf/(:num)', 'Pimpinan\SuratMasukController::exportPDF/$1');// <-- Route Baru
});
// Rute untuk validasi QR (Bisa diakses publik tanpa login)
$routes->get('validasi/cek/(:segment)', 'Validasi::cek/$1');

// Rute untuk tombol setujui (Masuk dalam grup Staf)
$routes->get('staf/arsip/setujui/(:num)', 'Staf\ArsipController::setujui/$1');