<?php

/**
 * MVC - Parent class of the controllers
 * Class Controller
 */
class Controller
{
    protected $controllerModel;

    /**
     * Check and load the model
     * @param $model
     * @return mixed
     */
    public function model($model)
    {
        require_once MODELS_PATH . $model . ".php";

        return new $model();
    }

    /**
     * Check and load the view
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        if (file_exists(VIEWS_PATH . $view . ".php")) {
            require_once VIEWS_PATH . $view . ".php";
        } else {
            die("Vista no encontrada.");
        }
    }
}
