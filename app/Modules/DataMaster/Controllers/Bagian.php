<?php
namespace App\Modules\DataMaster\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Modules\DataMaster\Models\BagianModel;

class Bagian extends BaseController{
    protected $bagianModel;

    function __construct()
    {
        $this->bagianModel = new BagianModel();
    }

    function index(){
        return view('App\Modules\DataMaster\Views\bagian_view');
    }

    function listBagian(){
        $rst['data'] = $this->bagianModel->findAll();

        echo json_encode($rst);
    }

    public function create(){
        $data = [
            'bagian' => $this->request->getVar('bagian'),

        ];
        $inserted = $this->bagianModel->insert($data);
        echo json_encode($inserted);
    }

    public function show($id = null){
        $data = $this->bagianModel->where('id', $id)->first();
        if(!$data){
            $status = 400;
            $error = 'Not Found';
            $msg = 'Data bagian dengan id ' . $id . ' tidak ditemukan!';
        }else{
            $status = 200;
            $error = null;
            $msg = null;
        }

        $response = [
            'status' => $status,
            'error' => $error,
            'message' => $msg
        ];        
        return json_encode($response);
    }    

    public function update($id = null){
        $data = $this->request->getRawInput();
        $data['id'] = $id;

        $dataExists = $this->bagianModel->where('id', $id)->findAll();
        if(!$dataExists){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data bagian dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->bagianModel->save($data);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data Bagian berhasil diupdate!'
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
        $data = $this->bagianModel->where('id', $id)->findAll();
        if(!$data){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data bagian dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->bagianModel->delete($id);
                $response = [
                    'status' => 200,
                    'error' => null,
                    'message' => 'Data Bagian berhasil di hapus!'
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