<?php
namespace App\Modules\Auth\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Modules\DataMaster\Models\UserModel;
use App\Modules\DataMaster\Models\KaryawanModel;

class Auth extends BaseController{
    protected $userModel;
    protected $session;
    protected $userIdSession;
    protected $karyawanModel;

    function __construct()
    {
        $this->userModel = new UserModel();
        $this->karyawanModel = new KaryawanModel();
        $this->session = \Config\Services::session();
    }

    public function index(){
        $this->userIdSession = $this->session->getTempdata('userIdSession');
        if(!$this->userIdSession){
            return view('App\Modules\Auth\Views\auth_view');
        }
        redirect('dashboard');
    }

    public function getAuth(){
        return view('App\Modules\Auth\Views\auth_view');
    }

    public function postRegister(){
        if(isset($_POST['nik'])){
            $nik = $_POST['nik'];
        }

        if(isset($_POST['user_name'])){
            $userName = $_POST['user_name'];
        }

        if(isset($_POST['psw'])){
            $password = $_POST['psw'];
        }
        
        $searchNIK = $this->karyawanModel->where('nik', $nik)->first();
        if(!$searchNIK){
            $response = [
                'status' => 400,
                'message' => 'NIK tidak ada!',
            ];            
            return json_encode($response);            
        }
        $karyawanId = $searchNIK['id'];
        $searchUserName = $this->userModel->where('user_name', $userName)->findAll();
        if($searchUserName){
            $response = [
                'status' => 400,
                'message' => 'User Name sudah digunakan!',
            ];            
            return json_encode($response);            
        }
        $dataRegister = [
            'karyawan_id' => $karyawanId,
            'user_name' => $userName,
            'password' => MD5($password)
        ];

        try{
            $registered = $this->userModel->insert($dataRegister);
            if($registered){
                $response = [
                    'status' => 200,
                    'message' => 'Register berhasil, silahkan Login',
                ];            
                return json_encode($response);                
            }
        }catch(Exception $e){
            $response = [
                'status' => 400,
                'message' => 'Register gagal, pesan error: ' . $e->getMessage(),
            ];            
            return json_encode($response);
        }
        //cari nik
        
    }

    public function postLogin(){
        if(isset($_POST['user_name'])){
            $userName = $_POST['user_name'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }

        $userNameFound = $this->userModel->where('user_name', $userName)->first();
        if(!$userNameFound){
            $response = [
                'status' => 400,
                'message' => 'User name tidak ada!',
            ];            
            return json_encode($response);
        }
        if(MD5($password) != $userNameFound['password']){
            $response = [
                'status' => 400,
                'message' => 'Password salah!',
            ];            
            return json_encode($response);
        }
        $this->session->setTempdata('userIdSession', $userNameFound['id'] ,7200);
        $this->userIdSession = $this->session->getTempdata('userIdSession');
        $response = [
            'status' => 200,
            'message' => 'Otentikasi berhasil'
        ];        
        return json_encode($response);        
    }

    public function logout(){
        $this->session->removeTempdata('userIdSession');
        return redirect('auth/getAuth');
    }

}