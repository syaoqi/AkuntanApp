<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoadJournalModel;

class LoadJournal extends BaseController
{
    protected $load_journal_model;

    public function __construct()
    {
        $this->load_journal_model = new LoadJournalModel();
    }

    public function index()
    {
        $data = [
            "title" => "Jurnal Umum Pembayaran Beban",
            "load_journals" => $this->load_journal_model->getAll()
        ];

        // dd($data["load_journals"]);

        return view("load_journals/load_journals_view", $data);
    }
}
