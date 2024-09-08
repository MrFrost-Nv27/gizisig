<?php

use App\Controllers\Api\PasienController;
use App\Controllers\Api\PuskesmasController;
use App\Controllers\Home;
use App\Controllers\Migrate;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

service('auth')->routes($routes);

$routes->environment('development', static function ($routes) {
    $routes->get('migrate', [Migrate::class, 'index']);
    $routes->get('migrate/(:any)', [Migrate::class, 'execute']);
});

$routes->group('puskesmas', function ($routes) {
    $routes->get('/', 'Puskesmas::index', ['as' => 'puskesmas']);
    $routes->get('add', 'Puskesmas::add', ['as' => 'puskesmas-add']);
    $routes->get('edit/(:num)', 'Puskesmas::edit/$1', ['as' => 'puskesmas-edit']);
});

$routes->group('pasien', function ($routes) {
    $routes->get('/', 'Pasien::index', ['as' => 'pasien']);
    $routes->get('add', 'Pasien::add', ['as' => 'pasien-add']);
    $routes->get('edit/(:num)', 'Pasien::edit/$1', ['as' => 'pasien-edit']);
});

$routes->get('/perpuskesmas', [Home::class, 'perpuskesmas']);
$routes->get('/klasterisasi', [Home::class, 'klasterisasi']);

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->get('distance', [PasienController::class, 'distance']);
    $routes->post('dbscan', [PasienController::class, 'dbscan']);
    $routes->resource('puskesmas', ['namespace' => '', 'controller' => PuskesmasController::class, 'websafe' => 1]);
    $routes->resource('pasien', ['namespace' => '', 'controller' => PasienController::class, 'websafe' => 1]);
});
