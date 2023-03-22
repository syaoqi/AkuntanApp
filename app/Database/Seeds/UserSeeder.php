<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();

        $users->insertBatch([
            [
                "name" => "Direktur",
                "email" => "direktur@mail.test",
                "phone" => "081234567890",
                "avatar" => "default.png",
                "address" => "Jl. Ubur-Ubur Raya, No.16 Taman Sari",
                "password" => password_hash("direktur", PASSWORD_DEFAULT),
                "role" => "director",
            ],
            [
                "name" => "Akuntan",
                "email" => "akuntan@mail.test",
                "phone" => "081234567890",
                "avatar" => "default.png",
                "address" => "Jl. Ubur-Ubur Raya, No.16 Taman Sari",
                "password" => password_hash("akuntan", PASSWORD_DEFAULT),
                "role" => "accountant",
            ],
            [
                "name" => "HRD",
                "email" => "hrd@mail.test",
                "phone" => "081234567890",
                "avatar" => "default.png",
                "address" => "Jl. Ubur-Ubur Raya, No.16 Taman Sari",
                "password" => password_hash("hrd", PASSWORD_DEFAULT),
                "role" => "hrd",
            ],
            [
                "name" => "Gudang",
                "email" => "gudang@mail.test",
                "phone" => "081234567890",
                "avatar" => "default.png",
                "address" => "Jl. Ubur-Ubur Raya, No.16 Taman Sari",
                "password" => password_hash("gudang", PASSWORD_DEFAULT),
                "role" => "warehouse",
            ],
            [
                "name" => "Bengkel",
                "email" => "bengkel@mail.test",
                "phone" => "081234567890",
                "avatar" => "default.png",
                "address" => "Jl. Ubur-Ubur Raya, No.16 Taman Sari",
                "password" => password_hash("bengkel", PASSWORD_DEFAULT),
                "role" => "workshop",
            ]
        ]);
    }
}
