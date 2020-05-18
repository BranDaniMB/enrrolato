<?php


class SystemError extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            "TITLE" => "Error | " . SITE_NAME
        ];
        $this->view("pages/error", $data);
    }
}