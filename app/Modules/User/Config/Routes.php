<?php
if(!isset($routes)){
    $routes = \Config\Services::routes();
}

$routes->group('user', ['namespace' => '\App\Modules\User\Controllers' ], function($subroutes){
    $subroutes->get('userProfile', 'User::userProfile');
    $subroutes->post('updateUser', 'User::updateUser');
    $subroutes->post('changeAvatar', 'User::changeAvatar');
    // $subroutes->post('login', 'Auth::postLogin');
    // $subroutes->post('register', 'Auth::postRegister');
    // $subroutes->get('logout', 'Auth::logout');
});