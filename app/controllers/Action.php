<?php

class Action extends Controller
{
    private array $returnData = array();

    public function __construct()
    {
        $this->controllerModel = $this->model("Actions");
    }

    public function index()
    {
        $this->returnData["success"] = false;
        $this->returnData["error"] = "No se ha seleccionado la acción, los datos están incompletos, no se puede llevar a cabo la acción.";
        echo "||$$||" . json_encode($this->returnData);
        $this->returnData = array();
    }

    public function add($type)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'icecream':
                    $model->createIceCream($_POST);
                    break;
                case 'flavor':
                    $model->createFlavor($_POST);
                    break;
                case 'filling':
                    $model->createFilling($_POST);
                    break;
                case 'topping':
                    $model->createTopping($_POST);
                    break;
                case 'container':
                    $model->createContainer($_POST);
                    break;
                case 'account':
                    $model->createTempAccount($_POST);
                    break;
                default:
                    $this->returnData["success"] = false;
                    $this->returnData["error"] = "El tipo de acción no es válida, no se puede llevar a cabo la acción, vuelva a intentarlo.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    break;
            }
        } else {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "El formulario no contiene datos o no son válidos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    public function edit($type)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'flavor':
                    $model->editFlavor($_POST);
                    break;
                case 'filling':
                    $model->editFilling($_POST);
                    break;
                case 'topping':
                    $model->editTopping($_POST);
                    break;
                case 'container':
                    $model->editContainer($_POST);
                    break;
                default:
                    $this->returnData["success"] = false;
                    $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
            }
        } else {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "El formulario no contiene datos o no son válidos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    public function delete($type)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($type) {
                case 'icecream':
                    $model->deleteIceCream($_POST);
                    break;
                case 'account':
                    if ($_POST["email"] == $_SESSION["payload"]["email"]) {
                        // Fail
                        $this->returnData["success"] = false;
                        $this->returnData["error"] = "No puedes eliminar el correo asociado a la sesión actual, inicia sesión con otro usuario e intenta de nuevo.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                    } else {
                        $model->deleteAccount($_POST);
                    }
                    break;
                case 'temp_account':
                    $model->deleteTempAccount($_POST);
                    break;
                case 'flavor':
                    $model->deleteFlavor($_POST);
                    break;
                case 'filling':
                    $model->deleteFilling($_POST);
                    break;
                case 'topping':
                    $model->deleteTopping($_POST);
                    break;
                case 'container':
                    $model->deleteContainer($_POST);
                    break;
                default:
                    $this->returnData["success"] = false;
                    $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    break;
            }
        } else {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "El formulario no contiene datos o no son válidos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    public function get($type)
    {
        session_start();
        $model = new Actions();
        switch ($type) {
            case 'account':
                break;
            case 'temp_account':
                break;
            case 'icecream':
                $model->getIceCream();
                break;
            case 'flavor':
                $model->getFlavors();
                break;
            case 'filling':
                $model->getFilling();
                break;
            case 'topping':
                $model->getTopping();
                break;
            case 'container':
                $model->getContainer();
                break;
            default:
                $this->returnData["success"] = false;
                $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
                break;
        }
    }
}