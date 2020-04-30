<?php


class Authentication extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("ModifyAccounts");
    }

    public function index()
    {
        $data = [
            "TITLE" => "Cuentas autorizadas | " . SITE_NAME
        ];
        $this->view("pages/modifyAccounts", $data);
    }
}