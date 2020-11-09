<?php

/**
 * MVC - Controller
 * Class Authentication
 * Set of methods for authentication
 */
class Authentication extends Controller
{
    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("Account");
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $data = [
            "TITLE" => "Cuentas autorizadas | " . SITE_NAME
        ];
        $this->view("pages/accounts", $data);
    }

    /**
     * Default page, login action
     */
    public function login()
    {
        $data = [
            "TITLE" => "Iniciar sesión | " . SITE_NAME
        ];
        $this->view("pages/login", $data);
    }

    /**
     * Logout page
     */
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /enrrolato/authentication/login/');
    }

    /**
     * Unauthorized account
     */
    public function loginerror()
    {
        $data = [
            "TITLE" => "No autorizado | " . SITE_NAME
        ];
        $this->view("pages/system", $data);
    }
}