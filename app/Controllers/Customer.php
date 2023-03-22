<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use Config\Services;


class Customer extends BaseController
{
    protected $customer_model;

    public function __construct()
    {
        $this->customer_model = new CustomerModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Pelanggan",
            "customers" => $this->customer_model->findAll(),
        ];

        return view("customers/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Pelanggan",
            "validation" => Services::validation(),
        ];

        return view("customers/create_view", $data);
    }

    public function store()
    {

        if (!$this->validate([
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Pelanggan tidak boleh kosong",
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

            $this->customer_model->insert($data);
            session()->setFlashdata("success", "Data pelanggan berhasil ditambahkan");
            return redirect()->route("data-pelanggan");
        }
    }

    public function edit($id)
    {
        $customer = $this->customer_model->find($id);
        $data = [
            "title" => "Ubah Data Pelanggan",
            "validation" => Services::validation(),
            "customer" => $customer,
        ];

        return view("customers/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama Pelanggan tidak boleh kosong",
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

            $this->customer_model->update($id, $data);
            session()->setFlashdata("success", "Data pelanggan berhasil diubah");
            return redirect()->route("data-pelanggan");
        }
    }

    public function destroy($id)
    {
        $this->customer_model->delete($id);
        session()->setFlashdata("success", "Data pelanggan berhasil dihapus");
        return redirect()->route("data-pelanggan");
    }
}
