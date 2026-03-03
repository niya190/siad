<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Menampilkan halaman form login
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('login/logout', 'Login::logout');

$routes->get('register', 'Login::register');
$routes->post('register/process', 'Login::registerProcess');

$routes->get('forgot-password', 'Login::forgotPassword');
$routes->post('forgot-password/process', 'Login::forgotPasswordProcess');
// Dashboard Pusat
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// ====================================================================
// GRUP ROUTE ADMIN
// ====================================================================
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

    // ARSIP ADMIN
    $routes->get('arsip/search', 'Admin\ArsipController::search'); 
    $routes->get('arsip/edit/(:num)', 'Admin\ArsipController::edit/$1');
    $routes->get('arsip/detail/(:num)', 'Admin\ArsipController::detail/$1');
    $routes->get('arsip/create', 'Admin\ArsipController::create');
    $routes->post('arsip/save', 'Admin\ArsipController::save');
    
    // Rute AJAX Lokasi Fisik Dinamis
    $routes->post('arsip/getLemari', 'Admin\ArsipController::getLemari');
    $routes->post('arsip/getRak', 'Admin\ArsipController::getRak');
    // Rute System Settings
    // Rute System Settings
    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings/save', 'Admin\SettingsController::save');
    $routes->get('settings/logs', 'Admin\SettingsController::logs');
    
    // Fitur Database
    $routes->get('settings/backup', 'Admin\SettingsController::backup');
    $routes->get('settings/reset', 'Admin\SettingsController::resetDatabase');
    $routes->get('arsip/export', 'Admin\ArsipController::export');
    $routes->post('arsip/export/process', 'Admin\ArsipController::processExport');
    $routes->get('notifications', 'Admin\NotificationController::index');

    // Kelola Master Data Lokasi (Penyimpanan)
    // Kelola Master Data Lokasi (Penyimpanan 4 Level)
    $routes->get('lemari', 'Admin\LemariController::index'); 
    
    // Rute Simpan
    $routes->post('lemari/simpan-gedung', 'Admin\LemariController::simpanGedung');
    $routes->post('lemari/simpan-ruangan', 'Admin\LemariController::simpanRuangan');
    $routes->post('lemari/simpan-lemari', 'Admin\LemariController::simpanLemari');
    $routes->post('lemari/simpan-rak', 'Admin\LemariController::simpanRak');

    // Rute Edit
    $routes->post('lemari/update-gedung/(:num)', 'Admin\LemariController::updateGedung/$1');
    $routes->post('lemari/update-ruangan/(:num)', 'Admin\LemariController::updateRuangan/$1');
    $routes->post('lemari/update-lemari/(:num)', 'Admin\LemariController::updateLemari/$1');
    $routes->post('lemari/update-rak/(:num)', 'Admin\LemariController::updateRak/$1');

    // Rute Hapus
    $routes->get('lemari/hapus-gedung/(:num)', 'Admin\LemariController::hapusGedung/$1');
    $routes->get('lemari/hapus-ruangan/(:num)', 'Admin\LemariController::hapusRuangan/$1');
    $routes->get('lemari/hapus-lemari/(:num)', 'Admin\LemariController::hapusLemari/$1');
    $routes->get('lemari/hapus-rak/(:num)', 'Admin\LemariController::hapusRak/$1');
});

// ====================================================================
// GRUP ROUTE STAF (INI YANG SUDAH DIPERBAIKI FULL)
// ====================================================================
$routes->group('staf', ['filter' => 'staf'], static function ($routes) {
    $routes->get('dashboard', 'Staf\DashboardController::index'); 
    
    // Navigasi Utama Staf
    $routes->get('arsip-masuk', 'Staf\ArsipMasukController::index');
    $routes->get('arsip-keluar', 'Staf\ArsipKeluarController::index');
    $routes->get('nota-dinas', 'Staf\NotaDinasController::index');
    $routes->get('laporan', 'Staf\LaporanController::index');

    // CRUD ARSIP STAF (INI KUNCI BIAR GAK 404)
    $routes->get('arsip', 'Staf\ArsipController::index');
    $routes->get('arsip/create', 'Staf\ArsipController::create');
    $routes->post('arsip/simpan', 'Staf\ArsipController::save');
    $routes->get('arsip/delete/(:num)', 'Staf\ArsipController::delete/$1');
    
    // --> INI DIA YANG BIKIN ERROR KALAU HILANG <--
    $routes->get('arsip/detail/(:num)', 'Staf\ArsipController::detail/$1');
    $routes->get('arsip/edit/(:any)', 'Staf\ArsipController::edit/$1');
    $routes->post('arsip/update/(:num)', 'Staf\ArsipController::update/$1');
    $routes->get('aktivitas', 'Staf\AktivitasController::index');
    $routes->get('klasifikasi/populer', 'Staf\KlasifikasiController::populer');     
    $routes->get('penyimpanan', 'Staf\PenyimpananController::index');
    // Rute AJAX Dropdown Dinamis Staf
    // Rute AJAX Dropdown Dinamis Staf
    $routes->post('arsip/getRuangan', 'Staf\ArsipController::getRuangan'); // <-- Tambahkan baris ini
    $routes->post('arsip/getLemari', 'Staf\ArsipController::getLemari');
    $routes->post('arsip/getRak', 'Staf\ArsipController::getRak');
});

