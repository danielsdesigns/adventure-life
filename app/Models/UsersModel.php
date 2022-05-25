<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name','email','password'];
    protected $useTimestamps = true;
    protected $dateFormat = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data) {

        if (!isset($data['data']['password'])) return $data;

        $data['data']['password']= password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;

    }

}

