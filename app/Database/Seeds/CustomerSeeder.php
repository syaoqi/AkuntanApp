<?php

namespace App\Database\Seeds;

use App\Models\CustomerModel;
use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = new CustomerModel();

        $customers->insertBatch([
            [
                "name" => "Pelanggan Satu",
                "phone" => "08123456789",
                "address" => "Jl. Satu Dua Tiga",
            ],
            [
                "name" => "Pelanggan Dua",
                "phone" => "08987654321",
                "address" => "Jl. Dua Tiga Empat",
            ],
            [
                "name" => "Pelanggan Tiga",
                "phone" => "08567891234",
                "address" => "Jl. Tiga Empat Lima",
            ],
        ]);
    }
}
