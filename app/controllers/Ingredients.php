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

    public function edit($flavor) {
        $data = [
            "TITLE" => "Editar {$flavor} | " . SITE_NAME,
            "FLAVOR" => $flavor
        ];
        $this->view("pages/editIngredient", $data);
    }

    public function add($type) {
        $data = [
            "TITLE" => "Añadir ingrediente | " . SITE_NAME,
            "TYPE" => $type
        ];
        $this->view("pages/addIngredient", $data);
    }
}