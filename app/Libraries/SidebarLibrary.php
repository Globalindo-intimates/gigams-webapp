<?php
namespace App\Libraries;
use App\Modules\DataMaster\Controllers\Menu;

class SidebarLibrary{
    protected $menuController;
    public function loadMenus(){
        $session = \Config\Services::session();
        // $userModel = new UserModel();

        $userIdSession = $session->getTempdata('userIdSession');
        if($userIdSession){
            $this->menuController = new Menu();
            $response = $this->menuController->show($userIdSession);
            $data['menus'] = array();
            foreach($response['data'] as $element){
                $data['menus']['user_name'] = $element['user_name'];
                $data['menus']['nama_lengkap'] = $element['nama_lengkap'];
                // $data[$element['module']][] = $element;
                $data['menus']['module'][$element['module']][] = $element;
            }
            return view('layouts/sidebar', $data);
        }
        
    }
}