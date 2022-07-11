<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class BagianModel extends Model{
    protected $table = 'bagian_ga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'bagian'];
}