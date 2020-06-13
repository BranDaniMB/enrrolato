<?php


class Ingredients extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("FlavorsModel");
    }

    public function index()
    {
        $this->show();
    }

    public function show()
    {
        $data = [
            "TITLE" => "Ingredientes | " . SITE_NAME
        ];
        $this->view("pages/showIngredients", $data);
    }
}