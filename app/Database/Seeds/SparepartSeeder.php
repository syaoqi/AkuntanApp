<?php

namespace App\Database\Seeds;

use App\Models\SparepartModel;
use CodeIgniter\Database\Seeder;

class SparepartSeeder extends Seeder
{
    public function run()
    {
        $spareparts = new SparepartModel();

        $spareparts->insertBatch([
            [
                "category_id" => 1,
                "part_code" => "SP-220109282",
                "name" => "Smart Lamp v2",
                "stock" => "55",
                "initial_price" => "750000",
                "selling_price" => "785000",
                "image" => "default.png",
                "color" => "putih",
                "description" => "Dapat digunakan pada sebagian besar mobil"
            ]
        ]);
    }
}
