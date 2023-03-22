<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoadCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            "category_code" => [
                "type" => "VARCHAR",
                "constraint" => "11",
            ],
            "category_name" => [
                "type"  => "VARCHAR",
                "constraint" => "255"
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true,
            ]
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("load_categories");
    }

    public function down()
    {
        $this->forge->dropTable("load_categories");
    }
}
