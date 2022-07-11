<?php
if(!isset($routes)){
    $routes = \Config\Services::routes();
}

$routes->group('auth', ['namespace' => '\App\Modules\Auth\Controllers' ], function($subroutes){
    $subroutes->get('', 'Auth::index');
    $subroutes->get('getAuth', 'Auth::getAuth');
    $subroutes->post('login', 'Auth::postLogin');
    $subroutes->post('register', 'Auth::postRegister');
    $subroutes->get('logout', 'Auth::logout');
});