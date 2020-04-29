<?php

class Controller {
    // Cargar modelo
    public function model($model) {
        require_once MODELS_PATH . $model . ".php";

        return new $model();
    }

    // Cargar vistas
    public function view($view, $data = []) {
        if(file_exists( VIEWS_PATH . $view.".php")) {
            require_once VIEWS_PATH . $view.".php";
        } else {
            // Hay un error
            die("Vista no encontrada.");
        }
    }
}
