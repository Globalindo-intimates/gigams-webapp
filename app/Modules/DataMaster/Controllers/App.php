<?php
namespace App\Modules\DataMaster\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Modules\DataMaster\Models\ModulesAppDetailModel;

class App extends BaseController{
    protected $appModel;

    function __construct()
    {
        $this->appModel = new ModulesAppDetailModel();
    }

    public function index(){
        return view('App\Modules\DataMaster\Views\app_view');
    }

    public function getAppByModule($idModule){
        $rst['data'] = $this->appModel->where('id_module', $idModule)->findAll();

        echo json_encode($rst);
    }

    public function create(){
        $data = [
            'id_module' => $this->request->getVar('module'),
            'route' => $this->request->getVar('route'),
            'caption' => $this->request->getVar('caption'),
            'alias' => $this->request->getVar('alias')
        ];
        $inserted = $this->appModel->insert($data);
        echo json_encode($inserted);        
    }

    public function update($id = null){
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $dataExists = $this->appModel->where('id', $id)->findAll();
        if(!$dataExists){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data module app dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->appModel->save($data);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data module app berhasil diupdate!'
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
        $data = $this->appModel->where('id', $id)->findAll();
        if(!$data){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data module app dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->appModel->delete($id);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data module app berhasil di hapus!'
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