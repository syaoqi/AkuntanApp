<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Positions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "basic_salary" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "transport_allowance" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "meal_allowance" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            'total_salary' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable("positions");
    }

    public function down()
    {
        $this->forge->dropTable("positions");
    }
}
