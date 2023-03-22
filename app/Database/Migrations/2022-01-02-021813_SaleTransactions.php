<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SaleTransactions extends Migration
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
            "customer_id" => [
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
                "constraint" => 11,
            ],
            "total_amount" => [
                "type" => "FLOAT",
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
                "null" => true,
            ],
        ]);

        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sparepart_id', 'spareparts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('courier_id', 'couriers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('sale_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('sale_transactions');
    }
}
