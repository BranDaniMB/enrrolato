<?php


class Action extends Controller
{
    public function __construct()
    {
        $this->controllerModel = $this->model("Actions");
    }

    public function index()
    {
        $_SESSION["ERROR_TITLE"] = "Error al ejecutar la solicitud.";
        $_SESSION["ERROR_MESSAGE"] = "No se ha seleccionado la acción, los datos están incompletos, no se puede llevar a cabo la acción.";
        $_SESSION["ERROR_HREF"] = "/ingredients/";
        header('Location: /appError');
    }

    public function add($type)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'flavor':
                    if ($model->createFlavor($_POST)) {
                        $data = [
                            "TITLE" => "Sabor agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "create",
                            "SUCCESS_ACTION" => "Sabor agregado"
                        ];
                    }
                    break;
                case 'filling':
                    if ($model->createFilling($_POST)) {
                        $data = [
                            "TITLE" => "Relleno agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "create",
                            "SUCCESS_ACTION" => "Relleno agregado"
                        ];
                    }
                    break;
                case 'topping':
                    if ($model->createTopping($_POST)) {
                        $data = [
                            "TITLE" => "Topping agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "create",
                            "SUCCESS_ACTION" => "Topping agregado"
                        ];
                    }
                    break;
                case 'container':
                    if ($model->createContainer($_POST)) {
                        $data = [
                            "TITLE" => "Envase agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "create",
                            "SUCCESS_ACTION" => "Envase agregado"
                        ];
                    }
                    break;
                default:
                    $_SESSION["ERROR_TITLE"] = "Error al agregar el ingrediente.";
                    $_SESSION["ERROR_MESSAGE"] = "El tipo de sabor no es válido.";
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    header('Location: /appError');
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el ingrediente.";
            $_SESSION["ERROR_MESSAGE"] = "El formulario no contiene datos o no son válidos.";
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
        }
    }

    public function edit($type) {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'flavor':
                    if ($model->editFlavor($_POST)) {
                        $data = [
                            "TITLE" => "Sabor editado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "edit",
                            "SUCCESS_ACTION" => "Sabor editado"
                        ];
                    }
                    break;
                case 'filling':
                    if ($model->editFilling($_POST)) {
                        $data = [
                            "TITLE" => "Relleno editado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "edit",
                            "SUCCESS_ACTION" => "Relleno editado"
                        ];
                    }
                    break;
                case 'topping':
                    if ($model->editTopping($_POST)) {
                        $data = [
                            "TITLE" => "Topping editado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "edit",
                            "SUCCESS_ACTION" => "Topping editado"
                        ];
                    }
                    break;
                case 'container':
                    if ($model->editContainer($_POST)) {
                        $data = [
                            "TITLE" => "Envase editado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "edit",
                            "SUCCESS_ACTION" => "Envase editado"
                        ];
                    }
                    break;
                default:
                    $_SESSION["ERROR_TITLE"] = "Error al editar el ingrediente.";
                    $_SESSION["ERROR_MESSAGE"] = "El tipo de sabor no es válido.";
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    header('Location: /appError');
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            $_SESSION["ERROR_TITLE"] = "Error al editar el ingrediente.";
            $_SESSION["ERROR_MESSAGE"] = "El formulario no contiene datos o no son válidos.";
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
        }
    }
}