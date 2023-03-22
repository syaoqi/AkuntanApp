<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaDependentModel;
use App\Models\LoadJournalModel;
use Config\Services;

class BukuBesar extends BaseController
{
    protected $coa_dependent_model;
    protected $load_journal_model;

    public function __construct()
    {
        $this->coa_dependent_model = new CoaDependentModel();
        $this->load_journal_model = new LoadJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Buku Besar",
            // filter buku besar by date and type
            "validation" => Services::validation(),
            "coa_dependents" => $this->coa_dependent_model->findAll(),
        ];

        return view("buku_besar/index_view", $data);
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
            "journal_desc" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Jenis Buku Besar",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $start_date = $this->request->getPost("start_date");
            $end_date = $this->request->getPost("end_date");
            $journal_desc = $this->request->getPost("journal_desc");

            // filter buku_besar from load_journals
            $buku_besar = $this->load_journal_model->where("load_payment_date >=", $start_date)
                ->where("load_payment_date <=", $end_date)
                ->where("description", $journal_desc)
                ->findAll();

            if (!$buku_besar) {
                session()->setFlashdata("error", "Data Tidak Ditemukan");
                return redirect()->back();
            }

            $data = [
                "title" => "Buku Besar",
                "buku_besar" => $buku_besar,
            ];

            // dd($data["buku_besar"]);

            return view("buku_besar/buku_besar_view", $data);
        }
    }
}
