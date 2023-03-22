<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaPayrollModel;

use Config\Services;

class CoaPayroll extends BaseController
{
    protected $coa_payroll_model;

    public function __construct()
    {
        $this->coa_payroll_model = new CoaPayrollModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Akun Daftar Gaji",
            "coa_payrolls" => $this->coa_payroll_model->findAll()
        ];

        return view("coa_payrolls/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Akun Daftar Gaji",
            "validation" => Services::validation(),
        ];

        return view("coa_payrolls/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "coa_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Akun tidak boleh kosong",
                ],
            ],
            "coa_name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Akun tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }
        $data = [
            "coa_code" => $this->request->getVar("coa_code"),
            "coa_name" => $this->request->getVar("coa_name"),
        ];

        $this->coa_payroll_model->insert($data);

        session()->setFlashdata("success", "Data Akun Daftar Gaji berhasil ditambahkan");

        return redirect()->route("data-akun-penggajian");
    }

    public function edit($id)
    {
        $data = [
            "title" => "Ubah Data Akun Daftar Gaji",
            "validation" => Services::validation(),
            "coa_payroll" => $this->coa_payroll_model->find($id),
        ];

        return view("coa_payrolls/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "coa_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Akun tidak boleh kosong",
                ],
            ],
            "coa_name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Akun tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            "coa_code" => $this->request->getVar("coa_code"),
            "coa_name" => $this->request->getVar("coa_name"),
        ];

        $this->coa_payroll_model->update($id, $data);

        session()->setFlashdata("success", "Data Akun Daftar Gaji berhasil diubah");

        return redirect()->route("data-akun-penggajian");
    }

    public function destroy($id)
    {
        $this->coa_payroll_model->delete($id);

        session()->setFlashdata("success", "Data Akun Daftar Gaji berhasil dihapus");

        return redirect()->route("data-akun-penggajian");
    }
}
