<?php

namespace App\Database\Seeds;

use App\Models\CoaTransactionModel;
use CodeIgniter\Database\Seeder;

class CoaTransactionSeeder extends Seeder
{
    public function run()
    {
        $coa_transactions = new CoaTransactionModel();

        $coa_transactions->insertBatch([
            [
                "coa_code" => "101",
                "coa_name" => "Kas"
            ],
            [
                "coa_code" => "102",
                "coa_name" => "Persediaan Barang Dagang"
            ],
            [
                "coa_code" => "202",
                "coa_name" => "PPN Keluaran"
            ],
            [
                "coa_code" => "203",
                "coa_name" => "PPN Masukan"
            ],
            [
                "coa_code" => "400",
                "coa_name" => "Penjualan"
            ],
            [
                "coa_code" => "401",
                "coa_name" => "HPP"
            ]
        ]);
    }
}
