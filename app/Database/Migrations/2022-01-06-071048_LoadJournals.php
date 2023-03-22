<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoadJournals extends Migration
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
            "load_payment_date" => [
                "type" => "DATE",
                "null" => true,
            ],
            "load_payment_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "description" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "ref" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "journal_type" => [
                "type" => "ENUM",
                "constraint" => ["debit", "credit"],
            ],
            "total_price" => [
                "type" => "INT",
                "constraint" => 11,
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

        $this->forge->addForeignKey("load_payment_id", "load_payments", "id", "CASCADE", "CASCADE");
        $this->forge->addKey("id", true);
        $this->forge->createTable("load_journals");
    }

    public function down()
    {
        $this->forge->dropTable("load_journals");
    }
}
