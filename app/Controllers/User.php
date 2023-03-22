<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class User extends BaseController
{
    protected $user_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    public function index()
    {
        $data = [
            "title" => "Data Pengguna",
            "users" => $this->user_model->findAll(),
        ];

        return view("users/index_view", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Tambah Pengguna",
            "validation" => Services::validation(),
        ];

        return view("users/create_view", $data);
    }

    public function store()
    {
        if (!$this->validate([
            "name" => [
                "rules" => "required|min_length[5]|max_length[50]",
                "errors" => [
                    "required" => "Nama tidak boleh kosong",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
            "email" => [
                "rules" => "required|valid_email|is_unique[users.email]",
                "errors" => [
                    "required" => "Email tidak boleh kosong",
                    "valid_email" => "Email tidak valid",
                    "is_unique" => "Email sudah digunakan",
                ],
            ],
            "phone" => [
                "rules" => "required|min_length[10]|max_length[15]",
                "errors" => [
                    "required" => "Nomor telepon tidak boleh kosong",
                    "min_length" => "Nomor telepon minimal 10 karakter",
                    "max_length" => "Nomor telepon maksimal 15 karakter",
                ],
            ],
            "role" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Hak Akses terlebih dahulu",
                ],
            ],
            "password" => [
                "rules" => "required|min_length[6]|max_length[50]",
                "errors" => [
                    "required" => "Password tidak boleh kosong",
                    "min_length" => "Password minimal 6 karakter",
                    "max_length" => "Password maksimal 50 karakter",
                ],
            ],
            "password_confirm" => [
                "rules" => "required|matches[password]",
                "errors" => [
                    "required" => "Konfirmasi password tidak boleh kosong",
                    "matches" => "Konfirmasi password tidak sama",
                ],
            ],
        ])) {

            return redirect()->back()->withInput();
        } else {
            // cek jika user mengupload gambar
            if ($this->request->getFile("avatar")->getName() != "") {
                $avatar = $this->request->getFile("avatar");
                $avatar_name = $avatar->getRandomName();
                $avatar->move("uploads/avatars/", $avatar_name);
            } else {
                // jika tidak, return gambar default
                $avatar_name = "default.png";
            }

            $data = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "phone" => $this->request->getVar("phone"),
                "avatar" => $avatar_name,
                "address" => $this->request->getVar("address"),
                "password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
                "role" => $this->request->getVar("role"),
            ];

            $this->user_model->insert($data);
            session()->setFlashdata("success", "Pengguna baru berhasil ditambahkan");
            return redirect()->route("data-pengguna");
        }
    }

    public function edit($id)
    {
        $user = $this->user_model->find($id);
        $data = [
            "title" => "Edit Pengguna",
            "user" => $user,
            "validation" => Services::validation(),
        ];

        return view("users/edit_view", $data);
    }

    public function update($id)
    {
        $user = $this->user_model->find($id);

        if (!$this->validate([
            "name" => [
                "rules" => "required|min_length[5]|max_length[50]",
                "errors" => [
                    "required" => "Nama tidak boleh kosong",
                    "min_length" => "Nama minimal 5 karakter",
                    "max_length" => "Nama maksimal 50 karakter",
                ],
            ],
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Email tidak boleh kosong",
                    "valid_email" => "Email tidak valid",
                ],
            ],
            "phone" => [
                "rules" => "required|min_length[10]|max_length[15]",
                "errors" => [
                    "required" => "Nomor telepon tidak boleh kosong",
                    "min_length" => "Nomor telepon minimal 10 karakter",
                    "max_length" => "Nomor telepon maksimal 15 karakter",
                ],
            ],
            "role" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Pilih Hak Akses terlebih dahulu",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            // cek jika user mengupload gambar
            if ($this->request->getFile("avatar")->getName() != "") {
                $avatar = $this->request->getFile("avatar");
                $avatar_name = $avatar->getRandomName();
                $avatar->move("uploads/avatars/", $avatar_name);
                // remove foto profil lama
                if ($user["avatar"] != "default.png") {
                    unlink("uploads/avatars/" . $user["avatar"]);
                }
            } else {
                // jika tidak, return gambar default
                $avatar_name = $user["avatar"];
            }

            $data = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "phone" => $this->request->getVar("phone"),
                "avatar" => $avatar_name,
                "address" => $this->request->getVar("address"),
                "role" => $this->request->getVar("role"),
            ];

            $this->user_model->update($id, $data);
            session()->setFlashdata("success", "Data Pengguna berhasil diupdate");
            return redirect()->route("data-pengguna");
        }
    }

    public function destroy($id)
    {
        $user = $this->user_model->find($id);
        if ($user["avatar"] != "default.png") {
            unlink("uploads/avatars/" . $user["avatar"]);
        }

        $this->user_model->delete($id);

        session()->setFlashdata('success', 'Data pengguna berhasil dihapus');

        return redirect()->route('data-pengguna');
    }
}
