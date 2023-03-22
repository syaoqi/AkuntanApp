<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true,
                "unsigned" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "address" => [
                "type" => "TEXT",

            ],
            "phone" => [
                "type" => "VARCHAR",
                "constraint" => 20,
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("customers");
    }

    public function down()
    {
        $this->forge->dropTable("customers");
    }
}
