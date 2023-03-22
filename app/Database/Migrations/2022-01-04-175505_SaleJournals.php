<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InventoryJournals extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            "sale_transaction_id" => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            "description" => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            "ref" => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            "journal_type" => [
                "type" => "ENUM",
                "constraint" => ["debit", "credit"],
            ],
            "total_price" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            'created_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addForeignKey('sale_transaction_id', 'sale_transactions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id', true);
        $this->forge->createTable('sale_journals');
    }

    public function down()
    {
        $this->forge->dropTable('sale_journals');
    }
}
