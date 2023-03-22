<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaDependentModel;

use Config\Services;

class CoaDependent extends BaseController
{
    protected $coa_dependent_model;

    public function __construct()
    {
        $this->coa_dependent_model = new CoaDependentModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Akun Tanggungan",
            "coa_dependents" => $this->coa_dependent_model->findAll()
        ];

        return view("coa_dependents/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Akun Tanggungan",
            "validation" => Services::validation(),
        ];

        return view("coa_dependents/create_view", $data);
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

        $this->coa_dependent_model->insert($data);

        session()->setFlashdata("success", "Data Akun Tanggungan berhasil ditambahkan");

        return redirect()->route("data-akun-tanggungan");
    }

    public function edit($id)
    {
        $data = [
            "title" => "Ubah Data Akun Tanggungan",
            "validation" => Services::validation(),
            "coa_dependent" => $this->coa_dependent_model->find($id),
        ];

        return view("coa_dependents/edit_view", $data);
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

        $this->coa_dependent_model->update($id, $data);

        session()->setFlashdata("success", "Data Akun Tanggungan berhasil diubah");

        return redirect()->route("data-akun-tanggungan");
    }

    public function destroy($id)
    {
        $this->coa_dependent_model->delete($id);

        session()->setFlashdata("success", "Data Akun Tanggungan berhasil dihapus");

        return redirect()->route("data-akun-tanggungan");
    }

}
