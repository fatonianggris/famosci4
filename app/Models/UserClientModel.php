<?php

namespace App\Models;

use CodeIgniter\Model;

class UserClientModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_clients';
    protected $primaryKey       = 'id_user_client';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'fullname',
        'username',
        'password',
        'email',
        'company_name',
        'npwp',
        'number_phone',
        'bank_number',
        'image',
        'image_thumb',
        'updated_at',
        'deleted_at',
        'user_status',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
