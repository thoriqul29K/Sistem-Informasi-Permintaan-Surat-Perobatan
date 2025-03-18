<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', "Pages::index");
$routes->get('/form-permintaan-surat', 'FormController::SIPSP');
$routes->post('/form/simpan', 'FormController::simpan');
