<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleTransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sale_transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "customer_id", "sparepart_id", "courier_id", "trx_code", "trx_date", "quantity", "total_amount", "note", "status", "created_at", "updated_at"
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

    // generate transaction code random
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

    // get all data and join with customer, courier, sparepart table
    public function getAll()
    {
        return $this->select('sale_transactions.*, customers.name as customer_name, couriers.name as courier_name, spareparts.name as sparepart_name')
            ->join('customers', 'sale_transactions.customer_id = customers.id')
            ->join('couriers', 'sale_transactions.courier_id = couriers.id')
            ->join('spareparts', 'sale_transactions.sparepart_id = spareparts.id')
            ->findAll();
    }
}
