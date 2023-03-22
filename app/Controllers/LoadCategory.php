<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CoaDependentModel;
use App\Models\LoadCategoryModel;
use Config\Services;

class LoadCategory extends BaseController
{
    protected $load_category_model;
    protected $coa_dependent_model;
    public function __construct()
    {
        $this->load_category_model = new LoadCategoryModel();
        $this->coa_dependent_model = new CoaDependentModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Kategori Beban",
            "load_category" => $this->load_category_model->findAll()
        ];

        return view("load_categories/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Kategori Beban",
            "validation" => Services::validation(),
            "category_code" => $this->load_category_model->generateCode(),
            "coa_dependents" => $this->coa_dependent_model->findAll()
        ];

        return view("load_categories/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([

            "category_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Beban Tidak boleh kosong"
                ]
            ],
            'category_name' => [
                'rules' => 'required', "unique" => "load_categories.category_name",
                'errors' => [
                    'required' => 'Nama Beban tidak boleh kosong',
                    'unique' => 'Nama Beban sudah ada'
                ]
            ],

        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'category_code' => $this->request->getVar('category_code'),
                'category_name' => $this->request->getVar('category_name'),
            ];

            $this->load_category_model->insert($data);
            session()->setFlashdata("success", "Data Kategori Beban berhasil ditambahkan");
            return redirect()->route("data-kategori-beban");
        }
    }

    public function edit($id)
    {
        $data = [
            "title" => "Update Kategori Beban",
            "validation" => Services::validation(),
            "load_category" => $this->load_category_model->find($id),
            "coa_dependents" => $this->coa_dependent_model->findAll()
        ];

        return view("load_categories/edit_view", $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            "category_code" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kode Beban Tidak boleh kosong"
                ]
            ],
            'category_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Beban tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'category_code' => $this->request->getVar('category_code'),
                'category_name' => $this->request->getVar('category_name'),
            ];

            $this->load_category_model->update($id, $data);
            session()->setFlashdata("success", "Data Kategori Beban berhasil diupdate");
            return redirect()->route("data-kategori-beban");
        }
    }

    public function destroy($id)
    {
        $this->load_category_model->delete($id);
        session()->setFlashdata("success", "Data Kategori Beban berhasil dihapus");
        return redirect()->route("data-kategori-beban");
    }
}
