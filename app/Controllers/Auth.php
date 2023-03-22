<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class Auth extends BaseController
{
    protected $user_model;
    protected $sesion;

    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        if ($this->session->get("is_login")) {
            return redirect()->route('/');
        }

        $data = [
            "title" => "Login",
            "validation" => Services::validation(),
        ];

        return view("auth/login_view", $data);
    }

    public function authAction()
    {

        if (!$this->validate([
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Email tidak boleh kosong",
                    "valid_email" => "Email tidak valid",
                ],
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Password tidak boleh kosong",
                ],
            ],
        ])) {
            return redirect()->back()->withInput();
        } else {
            $email = $this->request->getVar("email");
            $password = $this->request->getVar("password");

            $user_data = $this->user_model->where("email", $email)->first();

            if ($user_data) {
                $user_password  = $user_data["password"];

                $password_validation = password_verify($password, $user_password);

                if ($password_validation) {
                    $session_data = [
                        "id" => $user_data["id"],
                        "name" => $user_data["name"],
                        "email" => $user_data["email"],
                        "phone" => $user_data["phone"],
                        "avatar" => $user_data["avatar"],
                        "address" => $user_data["address"],
                        "role" => $user_data["role"],
                        "is_login" => TRUE
                    ];

                    $this->session->set($session_data);
                    return redirect()->route("/");
                } else {
                    $this->session->setFlashData("error", "Email atau Password kamu salah");
                    return redirect()->route("login");
                }
            } else {
                $this->session->setFlashData("error", "Email kamu tidak dikenali");
                return redirect()->route("login");
            }
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        return redirect()->to("/login");
    }
}
