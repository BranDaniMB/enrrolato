<?php


class Ingredients extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("IngredientsModel");
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

    public function edit($type, $ingredient) {
        $model = new IngredientsModel();
        $data = [
            "TITLE" => "Editar {$ingredient} | " . SITE_NAME,
            "TYPE" => $type,
            "INGREDIENT" => $model->getInfo(INGREDIENTS.'/'.$type.'s/'.$ingredient)
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