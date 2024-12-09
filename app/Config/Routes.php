<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'AuthController::login');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('barang', 'BarangController::index');
    $routes->get('barang/create', 'BarangController::create');
    $routes->post('barang/store', 'BarangController::store');
    $routes->get('barang/edit/(:num)', 'BarangController::edit/$1');
    $routes->post('barang/update/(:num)', 'BarangController::update/$1');
    $routes->get('barang/delete/(:num)', 'BarangController::delete/$1');

    $routes->get('transaksi', 'TransaksiController::index');
    $routes->get('transaksi/create', 'TransaksiController::create');
    $routes->post('transaksi/store', 'TransaksiController::store');
    $routes->get('transaksi/edit/(:num)', 'TransaksiController::edit/$1');
    $routes->post('transaksi/update/(:num)', 'TransaksiController::update/$1');
    $routes->get('transaksi/delete/(:num)', 'TransaksiController::delete/$1');

    $routes->get('print', 'TransaksiController::printPage');
    $routes->get('print/transaksi/(:num)', 'TransaksiController::printTransaksi/$1');

    $routes->get('users', 'UsersController::index');
    $routes->get('/users/create', 'AuthController::createUser');
    $routes->post('/users/store', 'AuthController::storeUser');
    $routes->post('users/update/(:num)', 'UsersController::update/$1');
    $routes->get('users/delete/(:num)', 'UsersController::delete/$1');

    $routes->get('/profile', 'AuthController::editProfile');
    $routes->post('/profile', 'AuthController::updateProfile');

    $routes->get('/change-password', 'AuthController::changePassword');
    $routes->post('/change-password', 'AuthController::updatePassword');
});

$routes->get('login', 'AuthController::login', ['as' => 'login']);
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('logout', 'AuthController::logout');
