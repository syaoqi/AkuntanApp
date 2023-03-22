<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PositionModel;
use Config\Services;

class Employee extends BaseController
{
    protected $employee_model;
    protected $position_model;

    public function __construct()
    {
        $this->employee_model = new EmployeeModel();
        $this->position_model = new PositionModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Karyawan",
            "employees" => $this->employee_model->getAllEmployees(),
        ];

        return view("employees/index_view", $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Karyawan',
            'validation' => Services::validation(),
            'positions' => $this->position_model->findAll()
        ];

        return view('employees/create_view', $data);
    }

    public function store()
    {

        if (!$this->validate([

            "position_id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Jabatan karyawan terlebih dahulu"
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Jenis Karyawan Terlebih dahulu'
                ]
            ],
            'nik' => [
                'rules' => 'required|is_unique[employees.nik]',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong',
                    'is_unique' => 'NIK sudah terdaftar pada sistem'
                ]
            ],
            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Karyawan tidak boleh kosong!'
                ]
            ],

            "gender" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Jenis Kelamin"
                ]
            ],
            'address' => [
                'rules' => 'required[employees.address]',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong!'
                ]
            ],
            "start_working_at" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Tanggal Mulai Bekerja"
                ]
            ],
            "status" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Status Karyawan"
                ]
            ]

        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'position_id' => $this->request->getVar('position_id'),
                'type' => $this->request->getVar('type'),
                'nik' => $this->request->getVar('nik'),
                'full_name' => $this->request->getVar('full_name'),
                'npwp' => $this->request->getVar('npwp'),
                'npwp_status' => $this->request->getVar('npwp_status'),
                'ptkp' => $this->request->getVar('ptkp'),
                'gender' => $this->request->getVar('gender'),
                'address' => $this->request->getVar('address'),
                'start_working_at' => $this->request->getVar("start_working_at"),
                'status' => $this->request->getVar('status'),
            ];

            // dd($data);

            $this->employee_model->insert($data);
            session()->setFlashdata("success", "Data jabatan berhasil ditambahkan");
            return redirect()->route("data-karyawan");
        }
    }

    public function edit($id)
    {
        $data = [
            "title" => "Update Data Karyawan",
            'validation' => Services::validation(),
            "employee" => $this->employee_model->find($id),
            'positions' => $this->position_model->findAll(),
        ];

        return view("employees/edit_view", $data);
    }

    public function update($id)
    {

        $employees = $this->employee_model->find($id);

        if ($employees['nik'] == $this->request->getVar('nik')) {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'required|is_unique[employees.nik]';
        }
        if (!$this->validate([
            'type' => [
                'rules' => 'required[employees.type]',
                'errors' => [
                    'required' => 'Tipe tidak boleh kosong!'
                ]
            ],

            'nik' => [
                'rules' => $rule_nik,
                'errors' => [
                    'required' => 'NIK tidak boleh kosong!',
                    'is_unique' => 'NIK Sudah tersedia'
                ]
            ],

            'full_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Karyawan tidak boleh kosong!'
                ]
            ],

            "gender" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Jenis Kelamin"
                ]
            ],
            'address' => [
                'rules' => 'required[employees.address]',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong!'
                ]
            ],
            "start_working_at" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Tanggal Mulai Bekerja"
                ]
            ],
            "status" => [
                "rules" => "required",
                "errors"  => [
                    "required" => "Pilih Status Karyawan"
                ]
            ]

        ])) {
            return redirect()->back()->withInput();
        } else {
            $data = [
                'position_id' => $this->request->getVar('position_id'),
                'type' => $this->request->getVar('type'),
                'nik' => $this->request->getVar('nik'),
                'full_name' => $this->request->getVar('full_name'),
                'npwp' => $this->request->getVar('npwp'),
                'npwp_status' => $this->request->getVar('npwp_status'),
                'ptkp' => $this->request->getVar('ptkp'),
                'gender' => $this->request->getVar('gender'),
                'address' => $this->request->getVar('address'),
                'start_working_at' => $this->request->getVar('start_working_at'),
                'status' => $this->request->getVar('status'),
            ];

            $this->employee_model->update($id, $data);
            session()->setFlashdata("success", "Data karyawan berhasil diubah");
            return redirect()->route("data-karyawan");
        }
    }

    public function destroy($id)
    {
        $this->employee_model->delete($id);
        session()->setFlashdata("success", "Data Karyawan berhasil dihapus");
        return redirect()->route("data-karyawan");
    }

    public function getDetail($id)
    {
        $employee = $this->employee_model->getEmployeeDetail($id);
        return json_encode($employee);
    }
}
