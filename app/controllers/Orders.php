<?php


class Orders extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->view("pages/orders");
    }
}