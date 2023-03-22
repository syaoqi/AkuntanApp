<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleJournalModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sale_journals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "sale_transaction_id", "description", "ref", "journal_type", "total_price", "created_at", "updated_at"
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

    // get all data and join with sales_transaction_table
    public function getAll()
    {
        return $this->select('sale_journals.*, sale_transactions.trx_code, sale_transactions.trx_date')
            ->join('sale_transactions', 'sale_transactions.id = sale_journals.sale_transaction_id')
            ->findAll();
    }
}
