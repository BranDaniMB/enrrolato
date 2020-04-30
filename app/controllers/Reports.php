<?php


class Reports extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Report");
    }

    public function index()
    {
        $data = [
            "TITLE" => "Generar reportes | " . SITE_NAME
        ];
        $this->view("pages/reports", $data);
    }
}