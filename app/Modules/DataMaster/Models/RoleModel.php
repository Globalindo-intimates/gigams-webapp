<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class RoleModel extends Model{
    protected $table = "bagian_ga";
    protected $allowedFields = ['id', 'bagian'];

    Public function getRoles($idBagian){
        $builder = $this->table('bagian_ga');
        $builder->select(
            'bagian_ga.bagian,
            module_ga.module,
            module_detail.route,
            module_detail.caption,
            module_detail.id'
        );
        $builder->join('apps_ga', 'bagian_ga.id = apps_ga.id_bagian');
        $builder->join('module_detail', 'apps_ga.id_module_detail = module_detail.id');
        $builder->join('module_ga', 'module_ga.id = module_detail.id_module');
        $builder->orderBy('bagian_ga.bagian');
        $builder->where('bagian_ga.id', $idBagian);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function insert_batch($data){
        $db      = \Config\Database::connect();
        $builder = $db->table('apps_ga');
        $query = $builder->insertBatch($data);

        return $query;
    }

    public function deleteWhere($idBagian, $idModuleDetail){
        $db      = \Config\Database::connect();
        $builder = $db->table('apps_ga');
        $builder->where('id_bagian', $idBagian);
        $builder->where('id_module_detail', $idModuleDetail);
        $query = $builder->delete();
        return $query;        
    }
}