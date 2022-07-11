<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model{
    protected $table = 'karyawan_ga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_bagian', 'nik', 'nama_lengkap', 'jenis_kelamin', 'shift'];
    
    public function getEmployees(){
        $builder = $this->table('karyawan_ga');
        $builder->select(
            'karyawan_ga.id, bagian_ga.id AS idBagian, bagian_ga.bagian, karyawan_ga.nik, 
             karyawan_ga.nik, karyawan_ga.nama_lengkap, karyawan_ga.jenis_kelamin, karyawan_ga.shift'
        );
        $builder->join('bagian_ga', 'karyawan_ga.id_bagian = bagian_ga.id');
        $builder->orderBy('karyawan_ga.id', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
}