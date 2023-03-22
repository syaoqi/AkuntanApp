<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CoaTransactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => '20',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'coa_code'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'coa_name'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'created_at'  => [
                'type'           => 'DATETIME',
                'null'           => TRUE,
            ],
            'updated_at'  => [
                'type'           => 'DATETIME',
                'null'           => TRUE,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('coa_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('coa_transactions');
    }
}
