<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "phone" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "avatar" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "default" => "default.png",
                "null" => true,
            ],
            "address" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "role" => [
                "type" => "ENUM",
                "constraint" => ["director", "accountant", "hrd", "warehouse", "workshop"],
                "default" => "workshop",
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

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}


