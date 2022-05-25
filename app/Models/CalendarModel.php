<?php namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model {

    protected $table      = 'calendar';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id','start','end','title', 'description'];
    protected $useTimestamps = true;
    protected $dateFormat = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}

