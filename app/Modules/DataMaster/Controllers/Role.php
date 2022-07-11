<?php
namespace App\Modules\DataMaster\Controllers;

use \App\Controllers\BaseController;
use App\Modules\DataMaster\Models\RoleModel;
use App\Modules\DataMaster\Models\ModulesAppDetailModel;

class Role extends BaseController{
    protected $roleModel;
    protected $appDetailModel;

    function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->appDetailModel = new ModulesAppDetailModel();
    }

    public function index(){
        return view('App\Modules\DataMaster\Views\role_view');
    }

    public function getRoleByIdBagian($id){
        $rst['data'] = $this->roleModel->getRoles($id);

        echo json_encode($rst);

    }

    public function getAppDetail($idModule){
        $rst['data'] = $this->appDetailModel->where('id_module', $idModule)->findAll();

        echo json_encode($rst);
    }

    public function create(){
        if(isset($_POST['data'])){
            $data = $_POST['data'];

            // var_dump($data);
            // exit;
            $inserted = $this->roleModel->insert_batch($data);

            echo json_encode($inserted);
        }
    }

    public function delete(){
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $idBagian = $data['id_bagian'];
            $idModuleDetail = $data['id_module_detail'];

            $deleted = $this->roleModel->deleteWhere($idBagian, $idModuleDetail);
            if($deleted){
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data Role berhasil di hapus!'
                ];                
                echo json_encode($response);
            }

        }
    }
}