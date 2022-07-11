<?php
namespace App\Modules\DataMaster\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Modules\DataMaster\Models\KaryawanModel;

class Karyawan extends BaseController{
    protected $karyawanModel;

    function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }

    function index(){
        return view('App\Modules\DataMaster\Views\karyawan_view');
    }

    function listKaryawan(){

        $rst['data'] = $this->karyawanModel->getEmployees();

        echo json_encode($rst);
    }

    public function create(){
        $data = [
            'id_bagian' => $this->request->getVar('id_bagian'),
            'nik' => $this->request->getVar('nik'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'shift' => $this->request->getVar('shift'),

        ];
        $inserted = $this->karyawanModel->insert($data);
        echo json_encode($inserted);
    }

    public function show($id = null){
        $data = $this->karyawanModel->where('id', $id)->first();
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

        $dataExists = $this->karyawanModel->where('id', $id)->findAll();
        if(!$dataExists){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data bagian dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->karyawanModel->save($data);
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
        $data = $this->karyawanModel->where('id', $id)->findAll();
        if(!$data){
            $response = [
                'status' => 400,
                'error' => 'Not Found',
                'message' => 'Data bagian dengan id ' . $id . ' tidak ditemukan!'  
            ];
            echo json_encode($response);
        }else{
            try{
                $this->karyawanModel->delete($id);
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