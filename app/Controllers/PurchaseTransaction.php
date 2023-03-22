<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourierModel;
use App\Models\PurchaseJournalModel;
use App\Models\PurchaseTransactionModel;
use App\Models\SparepartModel;
use App\Models\SupplierModel;
use Config\Services;

class PurchaseTransaction extends BaseController
{
    protected $purchase_transaction_model;
    protected $supplier_model;
    protected $sparepart_model;
    protected $courier_model;
    protected $purchase_journal_model;

    public function __construct()
    {
        $this->purchase_transaction_model = new PurchaseTransactionModel();
        $this->supplier_model = new SupplierModel();
        $this->sparepart_model = new SparepartModel();
        $this->courier_model = new CourierModel();
        $this->purchase_journal_model = new PurchaseJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Pembelian",
            "purchase_transactions" => $this->purchase_transaction_model->getAll()
        ];

        return view("transactions/purchases/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Pembelian",
            "validation" => Services::validation(),
            "suppliers" => $this->supplier_model->findAll(),
            "couriers" => $this->courier_model->findAll(),
            "spareparts" => $this->sparepart_model->findAll(),
            "trx_code" => $this->purchase_transaction_model->generateCode()
        ];

        return view("transactions/purchases/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "supplier_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Supplier Terlebih Dahulu",
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
            "supplier_id" => $this->request->getVar('supplier_id'),
            "sparepart_id" => $this->request->getVar('sparepart_id'),
            "courier_id" => $this->request->getVar('courier_id'),
            "quantity" => $this->request->getVar('quantity'),
            "total_amount" => $this->request->getVar('total_amount'),
            "note" => $this->request->getVar('note'),
        ];

        $sparepart = $this->sparepart_model->find($data["sparepart_id"]);
        $stock = $sparepart["stock"] + $data["quantity"];
        $this->sparepart_model->update($data["sparepart_id"], ["stock" => $stock]);

        $this->purchase_transaction_model->insert($data);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Disimpan');
        return redirect()->route("data-pembelian");
    }

    public function edit($id)
    {
        $data = [
            "title" => "Edit Data Pembelian",
            "validation" => Services::validation(),
            "purchase_transaction" => $this->purchase_transaction_model->find($id),
            "suppliers" => $this->supplier_model->findAll(),
            "couriers" => $this->courier_model->findAll(),
            "spareparts" => $this->sparepart_model->findAll()
        ];

        return view("transactions/purchases/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "supplier_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Supplier Terlebih Dahulu",
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
            "supplier_id" => $this->request->getVar('supplier_id'),
            "sparepart_id" => $this->request->getVar('sparepart_id'),
            "courier_id" => $this->request->getVar('courier_id'),
            "quantity" => $this->request->getVar('quantity'),
            "total_amount" => $this->request->getVar('total_amount'),
            "note" => $this->request->getVar('note'),
        ];

        $this->purchase_transaction_model->update($id, $data);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Diubah');
        return redirect()->route("data-pembelian");
    }

    public function confirm($id)
    {
        $data = [
            "status" => "success"
        ];

        $total_price = $this->purchase_transaction_model->find($id)["total_amount"];

        $purchase_journals = [
            [
                "purchase_transaction_id" => $id,
                "description" => "persediaan Barang Dagang",
                "ref" => "102",
                "journal_type" => "debit",
                "total_price" => $total_price,
            ],
            [
                "purchase_transaction_id" => $id,
                "description" => "PPN Masukan",
                "ref" => "203",
                "journal_type" => "debit",
                "total_price" => $total_price * 0.1,
            ],
            [
                "purchase_transaction_id" => $id,
                "description" => "Kas",
                "ref" => "101",
                "journal_type" => "credit",
                "total_price" => $total_price + $total_price * 0.1,
            ]
        ];

        $this->purchase_transaction_model->update($id, $data);
        $this->purchase_journal_model->insertBatch($purchase_journals);
        session()->setFlashdata('success', 'Data Transaksi Pembelian Berhasil Dikonfirmasi');
        return redirect()->back();
    }
}
