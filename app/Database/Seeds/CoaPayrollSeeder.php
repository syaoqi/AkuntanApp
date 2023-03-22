<?php

namespace App\Database\Seeds;

use App\Models\CoaPayrollModel;
use CodeIgniter\Database\Seeder;

class CoaPayrollSeeder extends Seeder
{
    public function run()
    {
        $coa_payrolls = new CoaPayrollModel();

        $coa_payrolls->insertBatch([
            [
                'coa_code' => '611',
                'coa_name' => 'Beban Gaji',
            ],
            [
                'coa_code' => '204',
                'coa_name' => 'Utang Gaji',
            ],
        ]);
    }
}
