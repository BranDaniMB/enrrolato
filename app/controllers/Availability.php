<?php


class Availability extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("ModifyAvailability");
    }

    public function index()
    {
        $this->ingredients();
    }

    public function ingredients()
    {
        $data = [
            "TITLE" => "Disponilidad de ingredientes | " . SITE_NAME
        ];
        $this->view("pages/ingredientAvailability", $data);
    }

    public function schedule()
    {
        $data = [
            "TITLE" => "Disponilidad de horarios | " . SITE_NAME
        ];
        $this->view("pages/scheduleAvailability", $data);
    }
}