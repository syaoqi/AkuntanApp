<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'employees';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [
    "id",
    'position_id',
    'type',
    'nik',
    'full_name',
    'npwp',
    'npwp_status',
    'ptkp',
    'gender',
    'address',
    'start_working_at',
    'status'
  ];

  // Dates
  protected $useTimestamps = true;
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

  // join table positions and employees using query builder
  public function getAllEmployees()
  {
    $this->select('employees.*, positions.name as position_name, positions.*');
    $this->join('positions', 'positions.id = employees.position_id');
    return $this->findAll();
  }

  // get employee detail
  public function getEmployeeDetail($id)
  {
    $this->select('employees.*, positions.name as position_name, positions.*');
    $this->join('positions', 'positions.id = employees.position_id');
    return $this->find($id);
  }
}
