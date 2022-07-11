<?php
namespace App\Modules\DataMaster\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'user_ga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'karyawan_id', 'user_name', 'password', 'token'];
}