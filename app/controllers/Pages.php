<?php


class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            "TITLE" => "Inicio | " . SITE_NAME
        ];
        $this->view("pages/main", $data);
    }

    public function about() {
        $data = [
            "TITLE" => "Acerca de | " . SITE_NAME
        ];
        $this->view("pages/about", $data);
    }
}