<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourierModel;
use App\Models\CustomerModel;
use App\Models\SaleJournalModel;
use App\Models\SaleTransactionModel;
use App\Models\SparepartModel;
use Config\Services;

class SaleTransaction extends BaseController
{
    protected $sale_transaction_model;
    protected $customer_model;
    protected $sparepart_model;
    protected $courier_model;
    protected $sale_journal_model;

    public function __construct()
    {
        $this->sale_transaction_model = new SaleTransactionModel();
        $this->customer_model = new CustomerModel();
        $this->sparepart_model = new SparepartModel();
        $this->courier_model = new CourierModel();
        $this->sale_journal_model = new SaleJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Penjualan",
            "sale_transactions" => $this->sale_transaction_model->getAll()
        ];

        return view("transactions/sales/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Penjualan",
            "validation" => Services::validation(),
            "customers" => $this->customer_model->findAll(),
            "spareparts" => $this->sparepart_model->findAll(),
            "couriers" => $this->courier_model->findAll(),
            "trx_code" => $this->sale_transaction_model->generateCode()
        ];

        return view("transactions/sales/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "customer_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Pelanggan Terlebih Dahulu",
                ],
            ],
            "sparepart_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Sparepart Terlebih Dahulu",
                ],
            ],
            "courier_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Kurir Terlebih Dahulu",
                ],
            ],
            "trx_date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Transaksi",
                ],
            ],
            "trx_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Transaksi tidak boleh kosong",
                ],
            ],
            "quantity" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Quantity tidak boleh kosong",
                ],
            ],
            "total_amount" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Total Pembayaran tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            "trx_code" => $this->request->getVar('trx_code'),
            "trx_date" => $this->request->getVar('trx_date'),
            "customer_id" => $this->request->getVar('customer_id'),
            "sparepart_id" => $this->request->getVar('sparepart_id'),
            "courier_id" => $this->request->getVar('courier_id'),
            "quantity" => $this->request->getVar('quantity'),
            "total_amount" => $this->request->getVar('total_amount'),
            "note" => $this->request->getVar('note'),
        ];

        // decrease stock on spareparts table - quantity
        $sparepart = $this->sparepart_model->find($data["sparepart_id"]);
        $stock = $sparepart["stock"] - $data["quantity"];
        $this->sparepart_model->update($data["sparepart_id"], ["stock" => $stock]);

        $this->sale_transaction_model->insert($data);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Disimpan');
        return redirect()->route("data-penjualan");
    }

    public function edit($id)
    {
        $data = [
            "title" => "Edit Data Penjualan",
            "validation" => Services::validation(),
            "customers" => $this->customer_model->findAll(),
            "spareparts" => $this->sparepart_model->findAll(),
            "couriers" => $this->courier_model->findAll(),
            "sale_transaction" => $this->sale_transaction_model->find($id)
        ];

        return view("transactions/sales/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "customer_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Pelanggan Terlebih Dahulu",
                ],
            ],
            "sparepart_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Sparepart Terlebih Dahulu",
                ],
            ],
            "courier_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Kurir Terlebih Dahulu",
                ],
            ],
            "trx_date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Transaksi",
                ],
            ],
            "trx_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Transaksi tidak boleh kosong",
                ],
            ],
            "quantity" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Quantity tidak boleh kosong",
                ],
            ],
            "total_amount" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Total Pembayaran tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            "trx_code" => $this->request->getVar('trx_code'),
            "trx_date" => $this->request->getVar('trx_date'),
            "customer_id" => $this->request->getVar('customer_id'),
            "sparepart_id" => $this->request->getVar('sparepart_id'),
            "courier_id" => $this->request->getVar('courier_id'),
            "quantity" => $this->request->getVar('quantity'),
            "total_amount" => $this->request->getVar('total_amount'),
            "note" => $this->request->getVar('note'),
        ];

        // decrease stock on spareparts table - quantity
        $sparepart = $this->sparepart_model->find($data["sparepart_id"]);
        $stock = $sparepart["stock"] - $data["quantity"];
        $this->sparepart_model->update($data["sparepart_id"], ["stock" => $stock]);

        $this->sale_transaction_model->update($id, $data);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Diubah');
        return redirect()->route("data-penjualan");
    }

    public function confirm($id)
    {

        $data = [
            "status" => "success"
        ];

        $total_price = $this->sale_transaction_model->find($id)["total_amount"];

        $sale_journals = [
            [
                "sale_transaction_id" => $id,
                "description" => "Kas",
                "ref" => "101",
                "journal_type" => "debit",
                "total_price" => $total_price + $total_price * 0.1
            ],
            [
                "sale_transaction_id" => $id,
                "description" => "PPN Keluaran",
                "ref" => "202",
                "journal_type" => "credit",
                "total_price" => $total_price * 0.1
            ],
            [
                "sale_transaction_id" => $id,
                "description" => "Penjualan",
                "ref" => "400",
                "journal_type" => "credit",
                "total_price" => $total_price
            ],
            [
                "sale_transaction_id" => $id,
                "description" => "HPP",
                "ref" => "401",
                "journal_type" => "debit",
                "total_price" => $total_price - $total_price * 0.1
            ],
            [
                "sale_transaction_id" => $id,
                "description" => "Persediaan Barang Dagang",
                "ref" => "402",
                "journal_type" => "credit",
                "total_price" => $total_price - $total_price * 0.1
            ],
        ];

        $this->sale_transaction_model->update($id, $data);
        $this->sale_journal_model->insertBatch($sale_journals);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Dikonfirmasi');
        return redirect()->back();
    }
}
