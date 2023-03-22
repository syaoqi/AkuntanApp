<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchaseTransactions extends Migration
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
            "supplier_id" => [
                "type" => "INT",
                "constraint" => 20,
                "unsigned" => true,
            ],
            "sparepart_id" => [
                "type" => "INT",
                "constraint" => 20,
                "unsigned" => true,
            ],
            "courier_id" => [
                "type" => "INT",
                "constraint" => 20,
                "unsigned" => true,
            ],
            "trx_code" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "trx_date" => [
                "type" => "DATE",
                "null" => true,
            ],
            "quantity" => [
                "type" => "INT",
                "null" => true,
            ],
            "total_amount" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => ["pending", "success"],
            ],
            "note" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null" => true,
            ],
            "updated_at" => [
                "type" => "DATETIME",
            ],
        ]);
        $this->forge->addForeignKey('supplier_id', 'suppliers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sparepart_id', 'spareparts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('courier_id', 'couriers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('purchase_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_transactions');
    }
}
