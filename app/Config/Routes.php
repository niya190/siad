<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Menampilkan halaman form login
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::attemptLogin'); 
$routes->get('login/logout', 'Login::logout');

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
    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings/save', 'Admin\SettingsController::save');
    $routes->get('arsip/export', 'Admin\ArsipController::export');
    $routes->post('arsip/export/process', 'Admin\ArsipController::processExport');
    $routes->get('notifications', 'Admin\NotificationController::index');
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
    $routes->get('arsip/detail/(:any
)', 'Staf\ArsipController::detail/$1'); 
    $routes->get('arsip/edit/(:any)', 'Staf\ArsipController::edit/$1');     
    
    
});

