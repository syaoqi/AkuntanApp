<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PayrollJournalModel;
use App\Models\PayrollModel;

class PayrollReport extends BaseController
{
    protected $payroll_journal_model;
    protected $payroll_model;

    public function __construct()
    {
        $this->payroll_journal_model = new PayrollJournalModel();
        $this->payroll_model = new PayrollModel();
    }

    public function payroll_journal()
    {
        $data = [
            "title" => "Laporan Penggajian Karyawan",
            "payroll_journals" => $this->payroll_journal_model->findAll(),
        ];

        return view("payrolls/reports/payroll_journal_view", $data);
    }

    public function payroll_report()
    {
        $data = [
            "title" => "Laporan Penggajian Karyawan",
            "payrolls" => $this->payroll_model->getPayrolls(),
        ];

        return view("payrolls/reports/payroll_report_view", $data);
    }
}
