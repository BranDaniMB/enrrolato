<?php


class Action extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Actions");
    }

    public function index()
    {

    }

    public function add($type)
    {
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'flavor':
                    $model->createFlavor($_POST);
                    $data = [
                        "TITLE" => "Sabor agregado | " . SITE_NAME,
                        "SUCCESS_ACTION" => "Sabor agregado"
                    ];
                    break;
                case 'filling':
                    $model->createFilling($_POST);
                    $data = [
                        "TITLE" => "Relleno agregado | " . SITE_NAME,
                        "SUCCESS_ACTION" => "Relleno agregado"
                    ];
                    break;
                case 'topping':
                    $model->createTopping($_POST);
                    $data = [
                        "TITLE" => "Topping agregado | " . SITE_NAME,
                        "SUCCESS_ACTION" => "Topping agregado"
                    ];
                    break;
                case 'container':
                    $model->createContainer($_POST);
                    $data = [
                        "TITLE" => "Envase agregado | " . SITE_NAME,
                        "SUCCESS_ACTION" => "Envase agregado"
                    ];
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            header('Location: /systemerror');
        }
    }
}