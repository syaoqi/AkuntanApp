<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaTransactionModel;
use Config\Services;

class CoaTransaction extends BaseController
{
    protected $coa_transaction_model;

    public function __construct()
    {
        $this->coa_transaction_model = new CoaTransactionModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Akun Transaksi",
            "coa_transactions" => $this->coa_transaction_model->findAll()
        ];

        return view("coa_transactions/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Akun Transaksi",
            "validation" => Services::validation(),
        ];

        return view("coa_transactions/create_view", $data);
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

        $this->coa_transaction_model->insert($data);

        session()->setFlashdata("success", "Data Akun Transaksi berhasil ditambahkan");

        return redirect()->route("data-akun-transaksi");
    }

    public function edit($id)
    {
        $data = [
            "title" => "Ubah Data Akun Transaksi",
            "validation" => Services::validation(),
            "coa_transaction" => $this->coa_transaction_model->find($id),
        ];

        return view("coa_transactions/edit_view", $data);
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

        $this->coa_transaction_model->update($id, $data);

        session()->setFlashdata("success", "Data Akun Transaksi berhasil diubah");

        return redirect()->route("data-akun-transaksi");
    }

    public function destroy($id)
    {
        $this->coa_transaction_model->delete($id);

        session()->setFlashdata("success", "Data Akun Transaksi berhasil dihapus");

        return redirect()->route("data-akun-transaksi");
    }

}
