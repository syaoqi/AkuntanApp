<?php

namespace App\Database\Seeds;

use App\Models\EmployeeModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = new EmployeeModel();

        $employees->insertBatch([
            [
                "position_id" => 1,
                "type" => "contract",
                "nik" => "5203141005990001",
                "full_name" => "Muhammad Kuswari",
                "npwp" => "123456789",
                "npwp_status" => "yes",
                "ptkp" => "TK/0",
                "gender" => "male",
                "address" => "Jl. Ubur-Ubur Raya, No.16, Taman Sari",
                "start_working_at" => "2021-05-10",
                "status" => "active",
            ]
        ]);
    }
}
