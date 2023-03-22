<?php

namespace App\Controllers;

use App\Models\SparepartModel;
use Config\Services;
use App\Models\CategoryModel;


class Sparepart extends BaseController
{
    protected $sparepart_model;

    public function __construct()
    {
        $this->sparepart_model = new SparepartModel();
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Sparepart",
            "spareparts" => $this->sparepart_model->getAllSparepart(),
        ];

        return view("spareparts/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Data Sparepart",
            "validation" => Services::validation(),
            "categories" => $this->category_model->findAll(),
            "part_code" => $this->sparepart_model->generateCode()
        ];

        return view("spareparts/create_view", $data);
    }

    public function store()
    {

        if (!$this->validate([
            "category_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kategori tidak boleh kosong",
                ],
            ],
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama tidak boleh kosong",
                ],
            ],
            "stock" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Persediaan tidak boleh kosong",
                ],
            ],
            "initial_price" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harga Awal tidak boleh kosong",
                ],
            ],
            "selling_price" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harga Jual tidak boleh kosong",
                ],
            ],
            "color" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Warna tidak boleh kosong",
                ],
            ],

        ])) {
            return redirect()->back()->withInput();
        } else {
            // cek jika user mengupload gambar
            if ($this->request->getFile("image")->getName() != "") {
                $image = $this->request->getFile("image");
                $image_name = $image->getRandomName();
                $image->move("uploads/spareparts/", $image_name);
            } else {
                // jika tidak, return gambar default
                $image_name = "default.png";
            }
            $data = [
                "part_code" => $this->request->getVar("part_code"),
                "category_id" => $this->request->getVar("category_id"),
                "name" => $this->request->getVar("name"),
                "stock" => $this->request->getVar("stock"),
                "initial_price" => $this->request->getVar("initial_price"),
                "selling_price" => $this->request->getVar("selling_price"),
                "image" => $image_name,
                "color" => $this->request->getVar("color"),
                "description" => $this->request->getVar("description"),
            ];

            $this->sparepart_model->insert($data);
            session()->setFlashdata("success", "Data onderdil berhasil ditambahkan");
            return redirect()->route("data-sparepart");
        }
    }

    public function edit($id)
    {

        $sparepart = $this->sparepart_model->find($id);
        $data = [
            "title" => "Ubah Data Sparepart",
            "sparepart" => $sparepart,
            "validation" => Services::validation(),
            "categories" => $this->category_model->findAll()

        ];

        return view("spareparts/edit_view", $data);
    }

    public function update($id)
    {
        $sparepart = $this->sparepart_model->find($id);

        if (!$this->validate([
            "category_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Kategori tidak boleh kosong",
                ],
            ],
            "name" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Nama tidak boleh kosong",
                ],
            ],
            "stock" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Persediaan tidak boleh kosong",
                ],
            ],
            "initial_price" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harga Awal tidak boleh kosong",
                ],
            ],
            "selling_price" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Harga Jual tidak boleh kosong",
                ],
            ],
            "color" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Warna tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            // cek jika user mengupload gambar
            if ($this->request->getFile("image")->getName() != "") {
                $image = $this->request->getFile("image");
                $image_name = $image->getRandomName();
                $image->move("uploads/spareparts/", $image_name);
                // remove foto profil lama

                if ($sparepart["image"] != "default.png") {
                    unlink("uploads/spareparts/" . $sparepart["image"]);
                }
            } else {
                // jika tidak, return gambar default
                $image_name = $sparepart["image"];
            }


            $data = [
                "part_code" => $this->request->getVar("part_code"),
                "category_id" => $this->request->getVar("category_id"),
                "name" => $this->request->getVar("name"),
                "stock" => $this->request->getVar("stock"),
                "initial_price" => $this->request->getVar("initial_price"),
                "selling_price" => $this->request->getVar("selling_price"),
                "image" => $image_name,
                "color" => $this->request->getVar("color"),
                "description" => $this->request->getVar("description"),
            ];

            $this->sparepart_model->update($id, $data);
            session()->setFlashdata("success", "Data Sparepart berhasil diubah");
            return redirect()->route("data-sparepart");
        }
    }

    public function destroy($id)
    {
        $this->sparepart_model->delete($id);
        session()->setFlashdata("success", "Data Sparepart berhasil dihapus");
        return redirect()->route("data-sparepart");
    }

    // get sparepart price
    public function getdetail($id)
    {
        $sparepart = $this->sparepart_model->find($id);
        return json_encode($sparepart);
    }
}
