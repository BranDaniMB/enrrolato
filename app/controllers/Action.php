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
                    if ($model->createFlavor($_POST)) {
                        $data = [
                            "TITLE" => "Sabor agregado | " . SITE_NAME,
                            "SUCCESS_ACTION" => "Sabor agregado"
                        ];
                    }
                    break;
                case 'filling':
                    if ($model->createFilling($_POST)) {
                        $data = [
                            "TITLE" => "Relleno agregado | " . SITE_NAME,
                            "SUCCESS_ACTION" => "Relleno agregado"
                        ];
                    }
                    break;
                case 'topping':
                    if ($model->createTopping($_POST)) {
                        $data = [
                            "TITLE" => "Topping agregado | " . SITE_NAME,
                            "SUCCESS_ACTION" => "Topping agregado"
                        ];
                    }
                    break;
                case 'container':
                    if ($model->createContainer($_POST)) {
                        $data = [
                            "TITLE" => "Envase agregado | " . SITE_NAME,
                            "SUCCESS_ACTION" => "Envase agregado"
                        ];
                    }
                    break;
                default:
                    $_SESSION["ERROR_TITLE"] = "Error al agregar el ingrediente.";
                    $_SESSION["ERROR_MESSAGE"] = "El tipo de sabor no es válido.";
                    header('Location: /systemerror');
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el ingrediente.";
            $_SESSION["ERROR_MESSAGE"] = "El formulario no contiene datos o no son válidos.";
            header('Location: /systemerror');
        }
    }
}