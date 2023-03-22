<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoadJournalModel;
use Config\Services;

class LabaRugi extends BaseController
{
    protected $load_journal_model;

    public function __construct()
    {
        $this->load_journal_model = new LoadJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Filter Laporan Laba Rugi",
            "validation" => Services::validation(),
        ];

        return view("laba_rugi/index_view", $data);
    }

    public function filter()
    {
        if (!$this->validate([
            "start_date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Tanggal Awal Buku Besar",
                ],
            ],
            "end_date" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Tanggal Akhir Buku Besar",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $start_date = $this->request->getPost("start_date");
            $end_date = $this->request->getPost("end_date");

            // get data from load_journals where description not kas and sum total_price field
            $laba_rugi = $this->load_journal_model->where("description != 'Kas'")
                ->where("load_payment_date >=", $start_date)
                ->where("load_payment_date <=", $end_date)
                ->select("description, sum(total_price) as total_price")
                ->findAll();

            // dd($laba_rugi);

            $data = [
                "title" => "Laporan Laba Rugi",
                "penjualan" => 11268567,
                "harga_pokok_penjualan" => 567567,
                "laba_rugi" => $laba_rugi,
            ];

            return view("laba_rugi/laporan_laba_rugi_view", $data);
        }
    }
}
