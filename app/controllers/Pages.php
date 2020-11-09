<?php

/**
 * MVC - Controller
 * Class Pages
 * Set of methods for main page
 */
class Pages extends Controller
{
    /**
     * Pages constructor.
     */
    public function __construct()
    {
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $data = [
            "TITLE" => "Inicio | " . SITE_NAME
        ];
        $this->view("pages/main", $data);
    }
}