<?php

namespace App\Database\Seeds;

use App\Models\CourierModel;
use CodeIgniter\Database\Seeder;

class CourierSeeder extends Seeder
{
    public function run()
    {
        $couriers = new CourierModel();

        $couriers->insertBatch([
            [
                "name" => "JNE",
                "phone" => "081234567890",
                "address" => "Jl. Kebon Jeruk No. 1",
            ],
            [
                "name" => "JNT",
                "phone" => "081234567891",
                "address" => "Jl. Kebon Jeruk No. 2",
            ],
            [
                "name" => "SICEPAT",
                "phone" => "081234567892",
                "address" => "Jl. Kebon Jeruk No. 3",
            ],
        ]);
    }
}
