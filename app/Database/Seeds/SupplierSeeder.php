<?php

namespace App\Database\Seeds;

use App\Models\SupplierModel;
use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = new SupplierModel();

        $suppliers->insertBatch([
            [
                "name" => "Supplier Satu",
                "phone" => "08123456789",
                "address" => "Jl. Satu Dua Tiga",
            ],
            [
                "name" => "Supplier Dua",
                "phone" => "08987654321",
                "address" => "Jl. Dua Tiga Empat",
            ],
            [
                "name" => "Supplier Tiga",
                "phone" => "08567891234",
                "address" => "Jl. Tiga Empat Lima",
            ],
        ]);
    }
}
