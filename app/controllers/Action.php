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
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    if ($model->createFlavor($_POST)) {
                        $data = [
                            "TITLE" => "Sabor agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "add",
                            "SUCCESS_ACTION" => "Sabor agregado"
                        ];
                    }
                    break;
                case 'filling':
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    if ($model->createFilling($_POST)) {
                        $data = [
                            "TITLE" => "Relleno agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "add",
                            "SUCCESS_ACTION" => "Relleno agregado"
                        ];
                    }
                    break;
                case 'topping':
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    if ($model->createTopping($_POST)) {
                        $data = [
                            "TITLE" => "Topping agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "add",
                            "SUCCESS_ACTION" => "Topping agregado"
                        ];
                    }
                    break;
                case 'container':
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
                    if ($model->createContainer($_POST)) {
                        $data = [
                            "TITLE" => "Envase agregado | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "add",
                            "SUCCESS_ACTION" => "Envase agregado"
                        ];
                    }
                    break;
                case 'account':
                    $_SESSION["ERROR_HREF"] = "/authentication/";
                    if ($model->createTempAccount($_POST)) {
                        $data = [
                            "TITLE" => "Cuenta agregada | " . SITE_NAME,
                            "TYPE" => $type,
                            "ACTION" => "add",
                            "SUCCESS_ACTION" => "Cuenta agregada"
                        ];
                    }
                    break;
                default:
                    $_SESSION["ERROR_TITLE"] = "Tipo de acción no definida";
                    $_SESSION["ERROR_MESSAGE"] = "El tipo de acción no es válida, no se puede llevar a cabo la acción, vuelva a intentarlo.";
                    header('Location: /appError');
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            $_SESSION["ERROR_TITLE"] = "Error al agregar.";
            $_SESSION["ERROR_MESSAGE"] = "El formulario no contiene datos o no son válidos.";
            header('Location: /appError');
        }
    }

    public function edit($type)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'flavor':
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
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
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
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
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
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
                    $_SESSION["ERROR_HREF"] = "/ingredients/";
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
                    $_SESSION["ERROR_TITLE"] = "Error al editar.";
                    $_SESSION["ERROR_MESSAGE"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                    header('Location: /appError');
                    break;
            }
            $this->view("pages/success", $data);
        } else {
            $_SESSION["ERROR_TITLE"] = "Error al editar.";
            $_SESSION["ERROR_MESSAGE"] = "El formulario no contiene datos o no son válidos.";
            header('Location: /appError');
        }
    }

    public function delete($type, $value)
    {
        session_start();
        $model = new Actions();
        switch ($type) {
            case 'account':
                $_SESSION["ERROR_HREF"] = "/authentication/";
                if ($model->deleteAccount($value)) {
                    $data = [
                        "TITLE" => "Cuenta autorizada eliminada | " . SITE_NAME,
                        "TYPE" => $type,
                        "ACTION" => "delete",
                        "SUCCESS_ACTION" => "Cuenta eliminada"
                    ];
                }
                break;
            case 'temp_account':
                $_SESSION["ERROR_HREF"] = "/authentication/";
                if ($model->deleteTempAccount($value)) {
                    $data = [
                        "TITLE" => "Acceso temporal eliminado | " . SITE_NAME,
                        "TYPE" => $type,
                        "ACTION" => "delete",
                        "SUCCESS_ACTION" => "Acceso temporal"
                    ];
                }
                break;
            default:
                $_SESSION["ERROR_TITLE"] = "Error al eliminar.";
                $_SESSION["ERROR_MESSAGE"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                header('Location: /appError');
                break;
        }
        $this->view("pages/success", $data);
    }
}