<?php
namespace App\Modules\User\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Modules\DataMaster\Models\UserModel;
use App\Modules\DataMaster\Models\KaryawanModel;

class User extends BaseController{
    protected $session;
    protected $userModel;
    protected $karyawanModel;

    function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->karyawanModel = new KaryawanModel();
    }

    public function userProfile(){
        $userId = $this->session->getTempdata('userIdSession');

        try{
            $dataUser = $this->userModel->find($userId);
            if($dataUser){
                $idKaryawan = $dataUser['karyawan_id'];
                $dataKaryawan['data'] = $this->karyawanModel->getEmployee($idKaryawan);
                // var_dump($dataKaryawan);
                // exit();
                if($dataKaryawan){
                    return view('App\Modules\User\Views\user_profile_view', $dataKaryawan);
                }
            }
        }catch(Exception $err){

        }
        
    }

    public function updateUser(){
        helper(['form', 'url']);

        $userId = $this->session->getTempdata('userIdSession');        
        // $idKaryawan = $this->request->getVar('id');
        // $userName = $this->request->getVar('userName');
        $oldPassword = $this->request->getVar('oldPassword');
        $newPassword = $this->request->getVar('newPassword');

        // $userNameFound = $this->userModel->where('user_name', $userName)->findAll();
        // if($userNameFound){
        //     $response = [
        //         'status' => 400,
        //         'msg' => 'User Name ' . $userName . ' sudah ada!'
        //     ];
        //     return json_encode($response);
        // }

        $dataUser = $this->userModel->find($userId);
        if($dataUser){
            if(MD5($oldPassword) != $dataUser['password']){
                $response = [
                    'status' => 400,
                    'msg' => 'Password lama salah!'
                ];
                echo json_encode($response);                
            }else{
                $dataForUser = [
                    'id' => $userId,
                    // 'user_name' => $userName,
                    'password' => md5($newPassword)
                ];
                $rst1 = $this->userModel->save($dataForUser);
                if($rst1){
                    $response = [
                        'status' => 200,
                        'msg' => 'Update User berhasil!'
                    ];
                    echo json_encode($response);            
                }
            }
        }

        // $validateImage = $this->validate([
        //     'file' => [
        //         'uploaded[file]',
        //         'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
        //         'max_size[file, 4096]',
        //     ],
        // ]);

        // if($validateImage){
        //     $imageFile = $this->request->getFile('file');
        //     $imageFile->move(WRITEPATH . 'uploads');
        //     $dataForKaryawan = [
        //         'id' => $idKaryawan,
        //         'image_url' => $imageFile->getClientName()
        //     ];
        //     $rst = $this->karyawanModel->save($dataForKaryawan);
        //     if($rst){
        //         $response = [
        //             'status' => 200,
        //             'msg' => 'Ganti photo berhasil!'
        //         ];
        //         echo json_encode($response);                
        //     }
        // }


    }

}