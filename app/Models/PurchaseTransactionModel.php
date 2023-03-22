<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseTransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'purchase_transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "sparepart_id", "supplier_id", "courier_id", "trx_code", "trx_date", "quantity", "total_amount", "note", "status", "created_at", "updated_at"
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

    public function generateCode()
    {
        $code = 'TRX-' . date('ymd') . rand(100, 999);
        $check = $this->where('trx_code', $code)->findAll();
        if ($check) {
            $this->generateCode();
        } else {
            return $code;
        }
    }

    // get all data and join with supplier, courier, sparepart table
    public function getAll()
    {
        return $this->select('purchase_transactions.*, suppliers.name as supplier_name, couriers.name as courier_name, spareparts.name as sparepart_name')
            ->join('suppliers', 'suppliers.id = purchase_transactions.supplier_id')
            ->join('couriers', 'couriers.id = purchase_transactions.courier_id')
            ->join('spareparts', 'spareparts.id = purchase_transactions.sparepart_id')
            ->findAll();
    }
}
