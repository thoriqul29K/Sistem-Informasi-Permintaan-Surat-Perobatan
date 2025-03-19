<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('/form-permintaan-surat', 'FormController::SIPSP');
$routes->post('/form/simpan', 'FormController::simpan');
$routes->get('/list_info', 'AdminController::index');
