<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->post('/form/simpan', 'FormController::simpan');
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('form-permintaan-surat', 'FormController::SIPSP');
});
$routes->get('logout', 'LogoutController::index');
$routes->group('', ['filter' => 'auth', 'admin'], function ($routes) {
    $routes->get('list-info', 'AdminController::index');
});
