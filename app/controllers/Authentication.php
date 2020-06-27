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

    public function add() {
        $data = [
            "TITLE" => "Agregar cuenta | " . SITE_NAME
        ];
        $this->view("pages/addAccount", $data);
    }

    public function login()
    {
        $data = [
            "TITLE" => "Iniciar sesión | " . SITE_NAME
        ];
        $this->view("pages/login", $data);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /enrrolato/authentication/login/');
    }

    public function loginerror()
    {
        $data = [
            "TITLE" => "No autorizado | " . SITE_NAME
        ];
        $this->view("pages/system", $data);
    }
}