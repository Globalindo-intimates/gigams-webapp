<?php 
namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController{
    public function index(){
        
        return view('App\Modules\Dashboard\Views\dashboard_view');        
    }
}