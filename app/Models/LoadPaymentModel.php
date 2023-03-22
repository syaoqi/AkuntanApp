<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadPaymentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'load_payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "trx_code", "trx_date", "load_category_id", "total_payment", "status", "created_at", "updated_at"
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
        $code = 'PBEB-' . date('ymd') . rand(100, 999);
        $check = $this->where('trx_code', $code)->findAll();
        if ($check) {
            $this->generateCode();
        } else {
            return $code;
        }
    }

    // join pembayaran beban table with kategori beban
    public function getAll()
    {
        return $this->select('load_payments.*, load_categories.category_name as load_category_name')->join('load_categories', 'load_categories.id = load_payments.load_category_id')->findAll();
    }

    // get load categoru name
    public function getLoadCategoryName($id)
    {
        return $this->select('load_categories.category_name')->join('load_categories', 'load_categories.id = load_payments.load_category_id')->where('load_payments.id', $id)->first();
    }
}
