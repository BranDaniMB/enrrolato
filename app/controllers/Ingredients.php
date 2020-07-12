<?php

/**
 * MVC - Controller
 * Class Ingredients
 * Set of methods for ingredients and components
 */
class Ingredients extends Controller
{
    /**
     * Ingredients constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("IngredientsModel");
    }

    /**
     * No method is provided, default page loads.
     */
    public function index()
    {
        $this->show();
    }

    /**
     * Default page, shows all the ingredients and components, allows its management by AJAX.
     */
    public function show()
    {
        $data = [
            "TITLE" => "Ingredientes | " . SITE_NAME
        ];
        $this->view("pages/showIngredients", $data);
    }

    /**
     * @deprecated  - replaced by AJAX
     * @param $type
     * @param $ingredient
     */
    public function edit($type, $ingredient) {
        $model = new IngredientsModel();
        $data = [
            "TITLE" => "Editando {$ingredient} | " . SITE_NAME,
            "TYPE" => $type,
            "INGREDIENT" => $model->getInfo(INGREDIENTS.'/'.$type.'s/'.$ingredient)
        ];
        $this->view("pages/editIngredient", $data);
    }

    /**
     * @deprecated - replaced by AJAX
     * @param $type
     */
    public function add($type) {
        $data = [
            "TITLE" => "Añadir ingrediente | " . SITE_NAME,
            "TYPE" => $type
        ];
        $this->view("pages/addIngredient", $data);
    }
}