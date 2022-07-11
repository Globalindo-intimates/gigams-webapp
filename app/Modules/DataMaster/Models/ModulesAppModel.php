<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class ModulesAppModel extends Model{
    protected $table = 'module_ga';
    protected $allowedFields = ['id', 'module', 'alias', 'icon'];
    
}