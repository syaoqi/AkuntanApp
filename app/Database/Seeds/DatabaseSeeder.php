<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // call and execute all seeders
        $this->call("UserSeeder");
        $this->call("CoaPayrollSeeder");
        $this->call("CoaTransactionSeeder");
        $this->call("CoaDependentSeeder");
        $this->call("CustomerSeeder");
        $this->call("SupplierSeeder");
        $this->call("CourierSeeder");
        $this->call("PositionSeeder");
        $this->call("EmployeeSeeder");
        $this->call("CategorySeeder");
        $this->call("SparepartSeeder");
    }
}
