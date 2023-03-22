<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use Config\Services;

class Category extends BaseController
{
    protected $category_model;

    public function __construct()
    {
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori',
            'categories' => $this->category_model->findAll(),
        ];

        return view("categories/index_view", $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
            "validation" => Services::validation(),
        ];

        return view("categories/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "name" => [
                "rules" => "required|min_length[5]|max_length[50]",
                "errors" => [
                    "required" => "Nama Kategori tidak boleh kosong",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            $this->category_model->insert($data);

            session()->setFlashdata('success', 'Kategori baru berhasil ditambahkan');
            return redirect()->to('/data-kategori');
        }
    }

    public function edit($id)
    {
        $category = $this->category_model->find($id);
        $data = [
            'title' => 'Edit Kategori',
            'category' => $category,
            "validation" => Services::validation(),
        ];

        return view("categories/edit_view", $data);
    }

    public function update($id)
    {
        $category = $this->category_model->find($id);

        if (!$this->validate([
            "name" => [
                "rules" => "required|min_length[5]|max_length[50]",
                "errors" => [
                    "required" => "Nama Kategori tidak boleh kosong",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
            ];

            $this->category_model->update($id, $data);

            session()->setFlashdata('success', 'Kategori berhasil diubah');
            return redirect()->to('/data-kategori');
        }
    }

    public function destroy($id)
    {
        $category = $this->category_model->find($id);

        $this->category_model->delete($id);

        session()->setFlashdata('success', 'Kategori berhasil dihapus');
        return redirect()->to('/data-kategori');
    }
}
