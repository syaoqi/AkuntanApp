<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use Config\Services;

class Supplier extends BaseController
{
    protected $supplier_model;

    public function __construct()
    {
        $this->supplier_model = new SupplierModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Supplier",
            "suppliers" => $this->supplier_model->findAll(),
        ];

        return view("suppliers/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Supplier",
            "validation" => Services::validation(),
        ];

        return view("suppliers/create_view", $data);
    }

    public function store()
    {

        if (!$this->validate([
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Supplier tidak boleh kosong",
                ],
            ],
            "address" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Alamat tidak boleh kosong",
                ],
            ],
            "phone" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nomor Ponsel tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                "name" => $this->request->getVar("name"),
                "address" => $this->request->getVar("address"),
                "phone" => $this->request->getVar("phone"),
            ];

            $this->supplier_model->insert($data);
            session()->setFlashdata("success", "Data Supplier berhasil ditambahkan");
            return redirect()->route("data-supplier");
        }
    }

    public function edit($id)
    {
        $supplier = $this->supplier_model->find($id);
        $data = [
            "title" => "Ubah Data Supplier",
            "validation" => Services::validation(),
            "supplier" => $supplier,
        ];

        return view("suppliers/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Supplier tidak boleh kosong",
                ],
            ],
            "address" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Alamat tidak boleh kosong",
                ],
            ],
            "phone" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nomor Ponsel tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                "name" => $this->request->getVar("name"),
                "address" => $this->request->getVar("address"),
                "phone" => $this->request->getVar("phone"),
            ];

            $this->supplier_model->update($id, $data);
            session()->setFlashdata("success", "Data Supplier berhasil diubah");
            return redirect()->route("data-supplier");
        }
    }

    public function destroy($id)
    {
        $this->supplier_model->delete($id);
        session()->setFlashdata("success", "Data Supplier berhasil dihapus");
        return redirect()->route("data-supplier");
    }
}
