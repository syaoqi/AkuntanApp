<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payrolls extends Migration
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
            "date" => [
                "type" => "DATE",
                "null" => true,
            ],
            "employee_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "basic_salary" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "units_sold" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "incentive" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "overtime_hours" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "overtime_pay" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "salary_cuts" => [
                "type" => "INT",
                "constraint" => 11,
            ],
            "net_salary" => [
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

        $this->forge->addForeignKey('employee_id', 'employees', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('id', true);
        $this->forge->createTable('payrolls');
    }

    public function down()
    {
        $this->forge->dropTable('payrolls');
    }
}
