<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaDependentModel;
use App\Models\LoadCategoryModel;
use App\Models\LoadJournalModel;
use App\Models\LoadPaymentModel;
use Config\Services;

class LoadPayment extends BaseController
{

    protected $load_payment_model;
    protected $load_category_model;
    protected $load_journal_model;
    protected $coa_dependent_model;

    public function __construct()
    {
        $this->load_payment_model = new LoadPaymentModel();
        $this->load_category_model = new LoadCategoryModel();
        $this->load_journal_model = new LoadJournalModel();
        $this->coa_dependent_model = new CoaDependentModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Pembayaran Beban",
            "load_payments" => $this->load_payment_model->getAll()
        ];

        return view("load_payments/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Pembayaran Beban",
            "validation" => Services::validation(),
            "load_categories" => $this->load_category_model->findAll(),
            "load_payment_code" => $this->load_payment_model->generateCode()
        ];

        return view("load_payments/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "trx_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Transaksi Pembayaran Beban Tidak boleh kosong"
                ]
            ],
            "load_category_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Kategori Beban Terlebih Dahulu"
                ]
            ],
            "trx_date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Tanggal Transaksi Pembayaran Beban Tidak boleh kosong"
                ]
            ],
            "total_payment" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Total Pembayaran Pembayaran Beban Tidak boleh kosong"
                ]
            ],

        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                "trx_code" => $this->request->getVar('trx_code'),
                "load_category_id" => $this->request->getVar('load_category_id'),
                "trx_date" => $this->request->getVar('trx_date'),
                "total_payment" => $this->request->getVar('total_payment'),
            ];

            $this->load_payment_model->insert($data);
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->route('data-pembayaran-beban');
        }
    }

    public function confirm($id)
    {

        $data = [
            "status" => "success"
        ];

        $date_load_payment = $this->load_payment_model->find($id)["trx_date"];
        $total_payment = $this->load_payment_model->find($id)["total_payment"];
        $load_category_id = $this->load_payment_model->find($id)["load_category_id"];
        $load_category_name = $this->load_category_model->find($load_category_id)["category_name"];
        $load_reff_code = $this->coa_dependent_model->getCoaCode($load_category_name)["coa_code"];

        $load_payments = [
            [
                "load_payment_date" => $date_load_payment,
                "load_payment_id" => $id,
                "description" => $load_category_name,
                "ref" => $load_reff_code,
                "journal_type" => "debit",
                "total_price" => $total_payment
            ],
            [
                "load_payment_date" => $date_load_payment,
                "load_payment_id" => $id,
                "description" => "Kas",
                "ref" => "111",
                "journal_type" => "credit",
                "total_price" => $total_payment
            ],
        ];

        $this->load_journal_model->insertBatch($load_payments);
        $this->load_payment_model->update($id, $data);
        session()->setFlashdata('success', 'Data Transaksi Penjualan Berhasil Dikonfirmasi');
        return redirect()->back();
    }
}
