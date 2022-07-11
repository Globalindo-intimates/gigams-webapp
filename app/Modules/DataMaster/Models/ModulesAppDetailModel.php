<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class ModulesAppDetailModel extends Model{
    protected $table = 'module_detail';
    protected $allowedFields = ['id', 'id_module', 'route', 'caption', 'alias'];

    public function getApps(){
        $builder = $this->table('module_detail');
        $builder->select(
            'module_detail.id, module_ga.id, module_ga.module,
             module_ga.icon, module_detail.route, module_detail.caption' 
        );
        $builder->join('module_ga', 'module_detail.id_module = module_ga.id');
        $query = $builder->get();

        return $query->getResultArray();
    }
}