<?php


class Schedule extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Schedule");
    }

    public function index()
    {
        $this->show();
    }

    public function show()
    {
        $data = [
            "TITLE" => "Horarios | " . SITE_NAME
        ];
        $this->view("pages/showSchedules", $data);
    }
}