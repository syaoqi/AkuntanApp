<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PurchaseJournalModel;
use App\Models\SaleJournalModel;
use App\Models\SparepartModel;

class InventoryReport extends BaseController
{
    protected $sale_journal_model;
    protected $purchase_journal_model;
    protected $sparepart_model;

    public function __construct()
    {
        $this->sale_journal_model = new SaleJournalModel();
        $this->purchase_journal_model = new PurchaseJournalModel();
        $this->sparepart_model = new SparepartModel();
    }

    public function sale_journal()
    {
        $data = [
            "title" => "Jurnal Umum Penjualan",
            "sale_journals" => $this->sale_journal_model->getAll()
        ];

        return view("transactions/journals/sale_journal_view", $data);
    }

    public function purchase_journal()
    {
        $data = [
            "title" => "Jurnal Umum Pembelian",
            "purchase_journals" => $this->purchase_journal_model->getAll()
        ];

        return view("transactions/journals/purchase_journal_view", $data);
    }

    public function stock_report()
    {
        $data = [
            "title" => "Laporan Stok",
            "spareparts" => $this->sparepart_model->getAll()
        ];

        // dd($data["spareparts"]);

        return view("transactions/reports/stock_report_view", $data);
    }
}
