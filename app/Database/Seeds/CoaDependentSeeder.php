<?php

namespace App\Database\Seeds;

use App\Models\CoaDependentModel;
use CodeIgniter\Database\Seeder;

class CoaDependentSeeder extends Seeder
{
    public function run()
    {
        $coa_depentend = new CoaDependentModel();

        $coa_depentend->insertBatch([
            [
                'coa_code' => '111',
                'coa_name' => 'Kas',
            ],
            [
                'coa_code' => '112',
                'coa_name' => 'Persediaan Barang Dagang',
            ],
            [
                "coa_code" => "113",
                "coa_name" => "Perlengkapan"
            ],
            [
                "coa_code" => "114",
                "coa_name" => "Sewa Dibayar dimuka"
            ],
            [
                "coa_code" => "115",
                "coa_name" => "Iklan Dibayar dimuka"
            ],
            [
                "coa_code" => "116",
                "coa_name" => "Piutang"
            ],
            [
                "coa_code" => "211",
                "coa_name" => "Utang"
            ],
            [
                "coa_code" => "212",
                "coa_name" => "Utang Gaji"
            ],
            [
                "coa_code" => "213",
                "coa_name" => "PPN keluaran"
            ],
            [
                "coa_code" => "214",
                "coa_name" => "PPN masukan"
            ],
            [
                "coa_code" => "311",
                "coa_name" => "Modal"
            ],
            [
                "coa_code" => "411",
                "coa_name" => "Penjualan"
            ],
            [
                "coa_code" => "412",
                "coa_name" => "Harga Pokok Penjualan"
            ],
            [
                "coa_code" => "413",
                "coa_name" => "Potongan Penjualan"
            ],
            [
                "coa_code" => "414",
                "coa_name" => "Retur Penjualan"
            ],
            [
                "coa_code" => "511",
                "coa_name" => "Pembelian"
            ],
            [
                "coa_code" => "512",
                "coa_name" => "Beban Listrik"
            ],
            [
                "coa_code" => "513",
                "coa_name" => "Beban Air"
            ],
            [
                "coa_code" => "514",
                "coa_name" => "Beban Gaji"
            ],
            [
                "coa_code" => "515",
                "coa_name" => "Beban Iklan"
            ],
            [
                "coa_code" => "516",
                "coa_name" => "Beban Sopir"
            ],
            [
                "coa_code" => "517",
                "coa_name" => "Beban Sewa"
            ],
            [
                "coa_code" => "518",
                "coa_name" => "Beban Asuransi"
            ],
            [
                "coa_code" => "519",
                "coa_name" => "Beban Makan"
            ],
            [
                "coa_code" => "520",
                "coa_name" => "Beban Makan"
            ],
            [
                "coa_code" => "521",
                "coa_name" => "Beban Lain-lain"
            ]
        ]);
    }
}
