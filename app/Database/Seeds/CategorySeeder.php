<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = new CategoryModel();

        $categories->insertBatch([
            [
                "name" => "Lampu Mobil",
                "description" => "Beragam Lampu Mobil",
            ],
            [
                "name" => "Kampas Rem",
                "description" => "Beragam Kampas Rem untuk motor dan mobil",
            ],
            [
                "name" => "Mesin",
                "description" => "Mesin untuk motor dan mobil",
            ],
        ]);
    }
}
