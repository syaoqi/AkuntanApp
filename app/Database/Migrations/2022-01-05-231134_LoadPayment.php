<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoadPayment extends Migration
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
            "trx_code" => [
                "type" => "VARCHAR",
                "constraint" => "255"
            ],
            "trx_date" => [
                "type" => "DATE",
                "null" => true
            ],
            "load_category_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true
            ],
            "total_payment" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => ["pending", "success"],
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
                "null" => true
            ],
        ]);

        $this->forge->addForeignKey("load_category_id", "load_categories", "id", "CASCADE", "CASCADE");
        $this->forge->addKey("id", true);
        $this->forge->createTable("load_payments");
    }

    public function down()
    {
        $this->forge->dropTable("load_payments");
    }
}
