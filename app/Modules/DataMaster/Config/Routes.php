<?php

use Config\Services;

if(!isset($routes)){
    $routes = Services::routes();
}

$routes->group('MasterData', ['namespace' => '\App\Modules\DataMaster\Controllers'], function($subroutes){
    // bagian
    $subroutes->get('bagian', 'Bagian::index');
    $subroutes->get('daftarBagian', 'Bagian::listBagian');
    $subroutes->get('bagian/show/(:num)', 'Bagian::show/$1');
    $subroutes->post('bagian/create', 'Bagian::create');
    $subroutes->put('bagian/update/(:num)', 'Bagian::update/$1');
    $subroutes->delete('bagian/delete/(:num)', 'Bagian::delete/$1');
    
    //karyawan
    $subroutes->get('karyawan', 'Karyawan::index');
    $subroutes->get('daftarKaryawan', 'Karyawan::listKaryawan');
    $subroutes->get('karyawan/show/(:num)', 'Karyawan::show/$1');
    $subroutes->post('karyawan/create', 'Karyawan::create');
    $subroutes->put('karyawan/update/(:num)', 'Karyawan::update/$1');
    $subroutes->delete('karyawan/delete/(:num)', 'Karyawan::delete/$1');
    
    // menu
    $subroutes->get('menu', 'Menu::index');
    $subroutes->get('daftarMenu', 'Menu::listMenu');
    $subroutes->get('menu/show/(:num)', 'Menu::show/$1');
    $subroutes->post('menu/create', 'Menu::create');
    $subroutes->put('menu/update/(:num)', 'Menu::update/$1');
    $subroutes->delete('menu/delete/(:num)', 'Menu::delete/$1');  
    
    //app
    $subroutes->get('aplikasi', 'App::index');
    $subroutes->get('aplikasi/daftarApp', 'App::listApp');
    $subroutes->get('aplikasi/detailApp/(:num)', 'App::getAppByModule/$1');
    $subroutes->post('aplikasi/create', 'App::create');
    $subroutes->post('aplikasi/update/(:num)', 'App::update/$1');
    $subroutes->post('aplikasi/delete/(:num)', 'App::delete/$1');

    //role
    $subroutes->get('role', 'Role::index');
    $subroutes->get('role/daftarRole', 'Role::listRole');
    $subroutes->get('role/getRole/(:num)', 'Role::getRoleByIdBagian/$1');
    $subroutes->get('role/detailRole/(:num)', 'Role::getAppByModule/$1');

    $subroutes->get('role/getAppDetail/(:num)', 'Role::getAppDetail/$1');
    $subroutes->post('role/create', 'Role::create');
    $subroutes->post('role/update/(:num)', 'Role::update/$1');
    $subroutes->post('role/delete', 'Role::delete');    
});