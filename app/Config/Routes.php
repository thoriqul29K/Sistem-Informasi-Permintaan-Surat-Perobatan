<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
$routes->get('/tentang', 'Pages::tentang');
$routes->get('/sop', 'Pages::sop');
$routes->get('/login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// Halaman form minta reset
$routes->get('reset-password',      'AuthController::showResetForm');
$routes->post('reset-password',     'AuthController::sendResetLink');
// Form set password baru via token
$routes->get('reset-password/(:segment)', 'AuthController::showNewPasswordForm/$1');
$routes->post('reset-password/(:segment)', 'AuthController::resetPassword/$1');


$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('form-permintaan-surat', 'FormController::SIPSP');
    $routes->post('/form/simpan', 'FormController::simpan');
});

$routes->group('', ['filter' => 'auth', 'admin'], function ($routes) {
    $routes->get('list-info', 'AdminController::index');
    $routes->get('admin/verify/(:num)', 'AdminController::verify/$1');
    $routes->post('admin/verify/(:num)', 'AdminController::verify/$1');
    $routes->post('admin/hapus/(:num)', 'AdminController::hapus/$1');
    // Opsional: route untuk penghapusan otomatis (untuk testing CLI)
});

$routes->group('', ['filter' => 'auth', 'role:ruler'], function ($routes) {
    $routes->post('ruler/decide/(:num)',   'RulerController::decide/$1');
    $routes->get('ruler/sign/(:num)/(:alphanum)', 'RulerController::sign/$1/$2');
});

$routes->group('', ['filter' => 'auth', 'role:admin,ruler'], function ($routes) {
    $routes->get('list-info', 'AdminController::index');
    $routes->get('admin/generate-pdf/(:num)', 'AdminController::generatePdf/$1');
    $routes->get('admin/detail/(:num)', 'AdminController::detail/$1');
});

// Menandai satu notifikasi sebagai dibaca
$routes->get('notifications/markread/(:num)', 'NotificationController::markRead/$1');
// Menampilkan halaman semua notifikasi
$routes->get('notifications', 'NotificationController::index');

$routes->get('progress_bar', 'Pages::progress_bar', ['filter' => 'auth']);
$routes->get('form/download-pdf/(:num)', 'FormController::downloadPdf/$1');
