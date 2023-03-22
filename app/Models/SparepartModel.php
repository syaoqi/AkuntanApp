<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'spareparts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'part_code',
        'category_id',
        'name',
        'stock',
        'initial_price',
        'selling_price',
        'image',
        'color',
        'description'
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
    public function getAllSparepart()
    {
        $this->select('spareparts.*, categories.name as categories_name');
        $this->join('categories', 'categories.id = spareparts.category_id');
        return $this->findAll();
    }

    // generate sparepart code random
    public function generateCode()
    {
        $code = 'SP-' . date('ymd') . rand(100, 999);
        $check = $this->where('part_code', $code)->findAll();
        if ($check) {
            $this->generateCode();
        } else {
            return $code;
        }
    }

    // get all spareparts data and join with sale_transactions table
    public function getAll()
    {
        $this->select('spareparts.*, sale_transactions.quantity as sale_transaction_quantity');
        $this->join('sale_transactions', 'sale_transactions.sparepart_id = spareparts.id');
        return $this->findAll();
    }
}
