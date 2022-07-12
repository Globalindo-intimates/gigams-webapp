<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model{
    protected $table = 'karyawan_ga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_bagian', 'nik', 'nama_lengkap', 'jenis_kelamin', 'shift'];
    
    public function getEmployees(){
        $rst = $this->_get();

        return $rst;
    }

    public function getEmployee($id){
        $rst = $this->_get($id);
        
        return $rst;
    }

    private function _get($id = null){
        $builder = $this->table('karyawan_ga');
        $builder->select(
            'karyawan_ga.id, bagian_ga.id AS idBagian, bagian_ga.bagian, karyawan_ga.nik, 
             karyawan_ga.nama_lengkap, karyawan_ga.jenis_kelamin,
             karyawan_ga.shift, karyawan_ga.image_url, user_ga.user_name'
        );
        $builder->join('user_ga', 'user_ga.karyawan_id = karyawan_ga.id');
        $builder->join('bagian_ga', 'karyawan_ga.id_bagian = bagian_ga.id');
        if($id){
            $builder->where('karyawan_ga.id', $id);
        }else{
            $builder->orderBy('karyawan_ga.id', 'DESC');
        }
        $query = $builder->get();

        return $query->getResultArray();
    }
}