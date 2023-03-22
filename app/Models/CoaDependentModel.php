<?php

namespace App\Models;

use CodeIgniter\Model;

class CoaDependentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'coa_dependents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =  [
        "id", "coa_code", "coa_name", "created_at", "updated_at"
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

    // get coa_code by coa_name from parameter
    public function getCoaCode($coa_name)
    {
        $query = $this->db->table($this->table)
            ->select('coa_code')
            ->where('coa_name', $coa_name)
            ->get();

        return $query->getRowArray();
    }

    // filter buku besar
    public function filterBukuBesar($start_date, $end_date, $journal_type)
    {
        $query = $this->db->table($this->table)
            ->select('coa_code, coa_name, sum(debit) as debit, sum(credit) as credit')
            ->where('created_at >=', $start_date)
            ->where('created_at <=', $end_date)
            ->where('journal_type', $journal_type)
            ->groupBy('coa_code')
            ->get();

        return $query->getResultArray();
    }
}
