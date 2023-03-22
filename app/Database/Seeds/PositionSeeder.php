<?php

namespace App\Database\Seeds;

use App\Models\PositionModel;
use CodeIgniter\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = new PositionModel();

        $positions->insertBatch([
            [
                "name" => "Programmer",
                "basic_salary" => "5000000",
                "transport_allowance" => "50000",
                "meal_allowance" => "50000",
                "total_salary" => "10000000",
            ],
            [
                "name" => "Sales",
                "basic_salary" => "5000000",
                "transport_allowance" => "50000",
                "meal_allowance" => "50000",
                "total_salary" => "10000000",
            ],
            [
                "name" => "Manajer Sales",
                "basic_salary" => "5000000",
                "transport_allowance" => "50000",
                "meal_allowance" => "50000",
                "total_salary" => "10000000",
            ],
            [
                "name" => "Teknisi",
                "basic_salary" => "5000000",
                "transport_allowance" => "50000",
                "meal_allowance" => "50000",
                "total_salary" => "10000000",
            ],
        ]);
    }
}
