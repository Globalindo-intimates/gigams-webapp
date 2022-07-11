<?php
namespace App\Modules\DataMaster\Controllers;

use App\Controllers\BaseController;
use Exception;

use App\Modules\DataMaster\Models\ModulesAppModel;
use App\Modules\DataMaster\Models\MenuModel;
use App\Modules\DataMaster\Models\UserModel;

class Menu extends BaseController{
    
    protected $moduleAppModel;
    protected $menuModel;
    protected $userModel;

    function __construct()
    {
        $this->moduleAppModel = new ModulesAppModel();
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
    }

    public function index(){
        return view('App\Modules\DataMaster\Views\menu_view');
    }

    public function listMenu(){
        $rst = $this->moduleAppModel->findAll();

        $response = [
            'status' => 200,
            'error' => null,
            'data' => $rst
        ];

        echo json_encode($response);        
    }

    public function show($id = null){
        $data = $this->userModel->where('id', $id)->first();
        $karyawanId = $data['karyawan_id'];
        // var_dump($karyawanId);
        // exit();

        $data = $this->menuModel->getApps($karyawanId);

        $response = [
            'status' => 200,
            'error' => null,
            'data' => $data
        ];
        return $response;        
        // return $this->respond(json_encode($response));
    }    

    public function create(){
        $data = [
            'module' => $this->request->getVar('module'),
            'alias' => $this->request->getVar('alias'),
            'icon' => $this->request->getVar('icon'),
        ];
        $inserted = $this->moduleAppModel->insert($data);
        echo json_encode($inserted);
    }

    public function update($id = null){
        $data = $this->request->getRawInput();
        // var_dump($data);
        // exit();
        $data['id'] = $id;

        $dataExists = $this->moduleAppModel->where('id', $id)->findAll();
        if(!$dataExists){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data menu dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->moduleAppModel->save($data);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data menu berhasil diupdate!'
                ];
            }catch(Exception $err){
                $response = [
                    'status' => 400,
                    'error' => null,
                    'message' => $err->getMessage()
                ];                
            }
            echo json_encode($response);
        }
    }

    public function delete($id = null){
        $data = $this->moduleAppModel->where('id', $id)->findAll();
        if(!$data){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data menu dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->moduleAppModel->delete($id);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data Menu berhasil di hapus!'
                ];
            }catch(Exception $err){
                $response = [
                    'status' => 400,
                    'error' => null,
                    'message' => $err->getMessage()
                ];                
            }
            echo json_encode($response);
        }
    }    

}