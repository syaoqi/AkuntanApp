<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\PayrollJournalModel;
use App\Models\PayrollModel;
use Config\Services;

class Payroll extends BaseController
{
    protected $payroll_model;
    protected $employee_model;
    protected $payroll_journal_model;

    public function __construct()
    {
        $this->payroll_model = new PayrollModel();
        $this->employee_model = new EmployeeModel();
        $this->payroll_journal_model = new PayrollJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Penggajian Karyawan",
            "payrolls" => $this->payroll_model->getPayrolls(),
        ];

        return view("payrolls/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Penggajian Karyawan",
            "validation" => Services::validation(),
            "employees" => $this->employee_model->getAllEmployees(),
        ];

        return view("payrolls/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Tanggal tidak boleh kosong.",
                ]
            ],
            "employee_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih karyawan terlebih dahulu"
                ]
            ],
            "basic_salary" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Gaji pokok karyawan tidak boleh kosong"
                ]
            ],
            "units_sold" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Jumlah unit penjualan tidak boleh kosong"
                ]
            ],
            "incentive" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Insentif penjualan tidak boleh kosong"
                ]
            ],
            "overtime_hours" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Jam Lembur tidak boleh kosong"
                ]
            ],
            "overtime_pay" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Uang Lembur tidak boleh kosong"
                ]
            ],
            "salary_cuts" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Potongan tidak boleh kosong"
                ]
            ],
            "net_salary" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Total gaji tidak boleh kosong"
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            "date" => $this->request->getVar("date"),
            "employee_id" => $this->request->getPost("employee_id"),
            "basic_salary" => $this->request->getPost("basic_salary"),
            "units_sold" => $this->request->getPost("units_sold"),
            "incentive" => $this->request->getPost("incentive"),
            "overtime_hours" => $this->request->getPost("overtime_hours"),
            "overtime_pay" => $this->request->getPost("overtime_pay"),
            "salary_cuts" => $this->request->getPost("salary_cuts"),
            "net_salary" => $this->request->getPost("net_salary"),
        ];

        $payroll_journals = [
            [
                "date" => $data["date"],
                "description" => "Beban Gaji",
                "ref" => "611",
                "journal_type" => "debit",
                "total_price" => $data["net_salary"],
            ],
            [
                "date" => $data["date"],
                "description" => "Utang Gaji",
                "ref" => "310",
                "journal_type" => "credit",
                "total_price" => $data["net_salary"],
            ],
        ];

        $this->payroll_model->insert($data);
        $this->payroll_journal_model->insertBatch($payroll_journals);

        session()->setFlashdata("success", "Data penggajian berhasil ditambahkan");

        return redirect()->route("data-penggajian");
    }
}
