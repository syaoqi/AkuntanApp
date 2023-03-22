<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PositionModel;
use Config\Services;

class Position extends BaseController
{
    protected $position_model;

    public function __construct()
    {
        $this->position_model = new PositionModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Jabatan Karyawan",
            "positions" => $this->position_model->findAll(),
        ];

        return view("positions/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Jabatan Karyawan",
            "validation" => Services::validation(),
        ];

        return view("positions/create_view", $data);
    }

    public function store()
    {

        if (!$this->validate([
            "name" => [
                "rules" => "required|min_length[5]|max_length[50]|is_unique[positions.name]",
                "errors" => [
                    "required" => "Nama Jabatan tidak boleh kosong",
                    "is_unique" => "Nama Jabatan sudah ada",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
            "basic_salary" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Gaji Pokok tidak boleh kosong",
                    "numeric" => "Gaji Pokok harus berupa angka",
                ],
            ],
            "transport_allowance" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Tunjangan Transport tidak boleh kosong",
                    "numeric" => "Tunjangan Transport harus berupa angka",
                ],
            ],
            "meal_allowance" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Tunjangan Makan tidak boleh kosong",
                    "numeric" => "Tunjangan Makan harus berupa angka",
                ],
            ],
            "total_salary" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Total Gaji tidak boleh kosong",
                    "numeric" => "Total Gaji harus berupa angka",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                "name" => $this->request->getVar("name"),
                "basic_salary" => $this->request->getVar("basic_salary"),
                "transport_allowance" => $this->request->getVar("transport_allowance"),
                "meal_allowance" => $this->request->getVar("meal_allowance"),
                "total_salary" => $this->request->getVar("total_salary"),
            ];

            $this->position_model->insert($data);
            session()->setFlashdata("success", "Data jabatan berhasil ditambahkan");
            return redirect()->route("data-jabatan");
        }
    }

    public function edit($id)
    {
        $position = $this->position_model->find($id);
        $data = [
            "title" => "Ubah Data Jabatan",
            "validation" => Services::validation(),
            "position" => $position,
        ];

        return view("positions/edit_view", $data);
    }

    public function update($id)
    {
        $position = $this->position_model->find($id);
        if ($position['name'] == $this->request->getVar('name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[positions.name]|min_length[5]|max_length[50]';
        }
        if (!$this->validate([
            "name" => [
                "rules" => $rule_name,
                "errors" => [
                    "required" => "Nama Jabatan tidak boleh kosong",
                    "is_unique" => "Nama Jabatan sudah ada",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
            "basic_salary" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Gaji Pokok tidak boleh kosong",
                    "numeric" => "Gaji Pokok harus berupa angka",
                ],
            ],
            "transport_allowance" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Tunjangan Transport tidak boleh kosong",
                    "numeric" => "Tunjangan Transport harus berupa angka",
                ],
            ],
            "meal_allowance" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Tunjangan Makan tidak boleh kosong",
                    "numeric" => "Tunjangan Makan harus berupa angka",
                ],
            ],
            "total_salary" => [
                "rules" => "required|numeric",
                "errors" => [
                    "required" => "Total Gaji tidak boleh kosong",
                    "numeric" => "Total Gaji harus berupa angka",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                "name" => $this->request->getVar("name"),
                "basic_salary" => $this->request->getVar("basic_salary"),
                "transport_allowance" => $this->request->getVar("transport_allowance"),
                "meal_allowance" => $this->request->getVar("meal_allowance"),
                "total_salary" => $this->request->getVar("total_salary"),
            ];

            $this->position_model->update($id, $data);
            session()->setFlashdata("success", "Data jabatan berhasil diubah");
            return redirect()->route("data-jabatan");
        }
    }

    public function destroy($id)
    {
        $this->position_model->delete($id);
        session()->setFlashdata("success", "Data jabatan berhasil dihapus");
        return redirect()->route("data-jabatan");
    }
}
