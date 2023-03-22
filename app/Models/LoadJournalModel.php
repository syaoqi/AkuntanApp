<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadJournalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'load_journals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "load_payment_date", "load_payment_id", "description", "ref", "journal_type", "total_price", "created_at", "updated_at"
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

    // get all data and join with jornal payment table and return as array
    public function getAll()
    {
        $query = $this->db->table($this->table)
            ->select('load_journals.*, load_payments.trx_date, load_payments.trx_code')
            ->join('load_payments', 'load_payments.id = load_journals.load_payment_id')
            ->get();
        return $query->getResultArray();
    }
}
