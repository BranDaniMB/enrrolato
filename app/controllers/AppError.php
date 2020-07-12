<?php

/**
 * MVC - Controller
 * Class AppError
 * You receive non-AJAX errors.
 */
class AppError extends Controller
{
    /**
     * AppError constructor.
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
            "TITLE" => "Error | " . SITE_NAME
        ];
        $this->view("pages/error", $data);
    }
}