<?php

/**
 * MVC - Controller
 * Class Reports
 * Set of methods for reports
 */
class Reports extends Controller
{
    /**
     * Reports constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("Report");
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $data = [
            "TITLE" => "Generar reportes | " . SITE_NAME
        ];
        $this->view("pages/reports", $data);
    }
}