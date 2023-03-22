<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'load_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "id", "category_code", "category_name", "created_at", "updated_at"
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

    // generate kategori beban code
    public function generateCode()
    {
        $code = 'KBEB-' . date('ymd') . rand(100, 999);
        $check = $this->where('category_code', $code)->findAll();
        if ($check) {
            $this->generateCode();
        } else {
            return $code;
        }
    }

    // join kategori beban table with pembayaran beban
    public function getAll()
    {
        $this->select('load_payment.*, load_category.nama as load_category_name');
        $this->join('load_category', 'load_category.id = load_payment.load_category_id');
        return $this->findAll();
    }
}
