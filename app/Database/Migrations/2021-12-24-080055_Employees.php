<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
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
            "position_id" => [
                "type" => "INT",
                "constraint" => 20,
                "unsigned" => true,
            ],
            "type" => [
                "type" => "ENUM",
                "constraint" => ["contract", "temporary"],
            ],
            "nik" => [
                "type" => "VARCHAR",
                "constraint" => 20,
            ],
            "full_name" => [
                "type" => "VARCHAR",
                "constraint" => 128,
            ],
            "npwp" => [
                "type" => "VARCHAR",
                "constraint" => 20,
                "null" => true,
            ],
            "npwp_status" => [
                "type" => "ENUM",
                "constraint" => ["yes", "no"],
                "default" => "no",
                "null" => true,
            ],
            "ptkp" => [
                "type" => "VARCHAR",
                "constraint" => 20,
                "null" => true,
            ],
            "gender" => [
                "type" => "ENUM",
                "constraint" => ["male", "female"]
            ],
            "address" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "start_working_at" => [
                "type" => "DATE",
                "null" => true
            ],
            "status" => [
                "type" => "enum",
                "constraint" => ["active", "inactive"],
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

        $this->forge->addForeignKey("position_id", "positions", "id", "CASCADE", "CASCADE");
        $this->forge->addKey("id", true);
        $this->forge->createTable("employees");
    }

    public function down()
    {
        $this->forge->dropTable("employees");
    }
}
