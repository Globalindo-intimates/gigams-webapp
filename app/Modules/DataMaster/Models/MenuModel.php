<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
    protected $table = 'user_ga';
    protected $allowedFields = ['id', 'karyawan_id', 'user_name', 'password', 'token'];
    
    function getApps($karyawanId){
        $builder = $this->table('user_ga');
        $builder->select('karyawan_ga.nama_lengkap, user_ga.user_name, 
                          module_ga.module, module_detail.route, 
                          module_detail.caption, module_ga.icon');

        $builder->join('karyawan_ga', 'user_ga.karyawan_id = karyawan_ga.id');
        $builder->join('bagian_ga', 'karyawan_ga.id_bagian = bagian_ga.id');
        $builder->join('apps_ga', 'bagian_ga.id = apps_ga.id_bagian');
        $builder->join('module_detail', 'apps_ga.id_module_detail = module_detail.id');
        $builder->join('module_ga', 'module_ga.id = module_detail.id_module');
        $builder->where('user_ga.karyawan_id', $karyawanId);
        $query = $builder->get();

        return $query->getResultArray();    
    }
}