<?php

/**
 * MVC - Controller
 * Class Schedule
 * Set of methods for schedules
 */
class Schedule extends Controller
{
    /**
     * Schedule constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("SchedulesModel");
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $this->show();
    }

    /**
     * Show current schedules
     */
    public function show()
    {
        $data = [
            "TITLE" => "Horarios | " . SITE_NAME
        ];
        $this->view("pages/showSchedules", $data);
    }
}