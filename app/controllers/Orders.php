<?php


class Orders extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Order");
    }

    public function index()
    {
        $data = [
            "TITLE" => "Órdenes | " . SITE_NAME
        ];
        $this->view("pages/orders", $data);
    }
}