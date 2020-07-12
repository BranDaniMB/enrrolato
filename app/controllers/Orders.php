<?php

/**
 * MVC - Controller
 * Class Orders
 * Set of methods for orders.
 */
class Orders extends Controller
{
    /**
     * Orders constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("Order");
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $data = [
            "TITLE" => "Órdenes | " . SITE_NAME
        ];
        $this->view("pages/orders", $data);
    }
}