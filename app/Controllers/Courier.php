<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourierModel;
use Config\Services;

class Courier extends BaseController
{
    protected $courier_model;

    public function __construct()
    {
        $this->courier_model = new CourierModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kurir',
            'couriers' => $this->courier_model->findAll(),
        ];
        return view('couriers/index_view', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kurir',
            'validation' => Services::validation(),
        ];
        return view('couriers/create_view', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ],
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor telepon tidak boleh kosong',
                ],
            ],
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'phone' => $this->request->getVar('phone'),
            'address' => $this->request->getVar('address'),
        ];

        $this->courier_model->insert($data);
        session()->setFlashdata('success', 'Data Kurir berhasil ditambahkan');
        return redirect()->route("data-kurir");
    }

    public function edit($id)
    {
        $courier = $this->courier_model->find($id);
        $data = [
            'title' => 'Ubah Data Kurir',
            'validation' => Services::validation(),
            'courier' => $courier,
        ];
        return view('couriers/edit_view', $data);
    }

    public function update($id)
    {
        $courier = $this->courier_model->find($id);

        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ],
            ],
            'phone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor telepon tidak boleh kosong',
                ],
            ],
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'phone' => $this->request->getVar('phone'),
            'address' => $this->request->getVar('address'),
        ];

        $this->courier_model->update($id, $data);
        session()->setFlashdata('pesan', 'Data Kurir berhasil diubah');
        return redirect()->route("data-kurir");
    }

    public function destroy($id)
    {
        $this->courier_model->delete($id);
        session()->setFlashdata('pesan', 'Data Kurir berhasil dihapus');
        return redirect()->route("data-kurir");
    }
}
