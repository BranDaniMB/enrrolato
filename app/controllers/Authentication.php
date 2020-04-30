<?php


class Authentication extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Account");
    }

    public function index()
    {
        $data = [
            "TITLE" => "Cuentas autorizadas | " . SITE_NAME
        ];
        $this->view("pages/modifyAccounts", $data);
    }

    public function login() {
        $data = [
            "TITLE" => "Iniciar sesión | " . SITE_NAME
        ];
        $this->view("pages/login", $data);
    }
}