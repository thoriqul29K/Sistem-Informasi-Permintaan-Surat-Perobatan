<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
$routes->get('/tentang', 'Pages::tentang');
$routes->get('/sop', 'Pages::sop');
$routes->get('/login', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('logout', 'LogoutController::index');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('form-permintaan-surat', 'FormController::SIPSP');
    $routes->post('/form/simpan', 'FormController::simpan');
});

$routes->group('', ['filter' => 'auth', 'admin'], function ($routes) {
    $routes->get('list-info', 'AdminController::index');
    $routes->get('admin/detail/(:num)', 'AdminController::detail/$1');
    $routes->get('admin/verify/(:num)', 'AdminController::verify/$1');
    $routes->post('admin/verify/(:num)', 'AdminController::verify/$1');
    $routes->get('admin/generate-pdf/(:num)', 'AdminController::generatePdf/$1');
    $routes->post('admin/hapus/(:num)', 'AdminController::hapus/$1');
    // Opsional: route untuk penghapusan otomatis (untuk testing CLI)
});

$routes->group('', ['filter' => 'auth', 'ruler'], function ($routes) {
    $routes->get('ruler',                 'RulerController::index');
    $routes->post('ruler/decide/(:num)',   'RulerController::decide/$1');
});
