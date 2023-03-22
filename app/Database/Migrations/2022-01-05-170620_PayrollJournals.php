<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PayrollJournals extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            "date" => [
                "type" => "DATE",
                "null" => true,
            ],

            "description" => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            "ref" => [
                'type'           => 'VARCHAR',
                'constraint'     => "11",
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('payroll_journals');
    }

    public function down()
    {
        $this->forge->dropTable('payroll_journals');
    }
}
