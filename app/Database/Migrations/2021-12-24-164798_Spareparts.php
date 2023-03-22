<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spareparts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "auto_increment" => true,
                "unsigned" => true,
            ],
            "category_id" => [
                "type" => "INT",
                "constraint" => 20,
                "unsigned" => true,
            ],
            "part_code" => [
                "type" => "VARCHAR",
                "constraint" => 20,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "stock" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "initial_price" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "selling_price" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "image" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "default" => "default.png",
                "null" => true,
            ],
            "color" => [
                "type" => "VARCHAR",
                "constraint" => 50,
            ],
            "description" => [
                "type" => "TEXT",

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

        $this->forge->addForeignKey("category_id", "categories", "id", "CASCADE", "CASCADE");
        $this->forge->addKey("id", true);
        $this->forge->createTable("spareparts");
    }

    public function down()
    {
        $this->forge->dropTable("spareparts");
    }
}
