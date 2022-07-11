<?php

use Config\Services;

if(!isset($routes)){
    $routes = Services::routes();
}

$routes->group('dashboard', ['namespace' => '\App\Modules\Dashboard\Controllers'], function($subroutes){
    // dashboard
    $subroutes->get('', 'Dashboard::index');
});