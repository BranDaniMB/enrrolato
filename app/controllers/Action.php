<?php

/**
 * MVC - Controller
 * Class Action
 * Set of all actions, built for AJAX
 */
class Action extends Controller
{
    /**
     * Represents the data returned to Ajax
     * @var array
     */
    private array $returnData = array();

    /**
     * Action constructor.
     */
    public function __construct()
    {
        $this->controllerModel = $this->model("Actions");
    }

    /**
     * No method is provided, default page loads.
     * In this case it is not allowed, please inform AJAX of this.
     */
    public function index()
    {
        $this->returnData["success"] = false;
        $this->returnData["error"] = "No se ha seleccionado la acción, los datos están incompletos, no se puede llevar a cabo la acción.";
        echo "||$$||" . json_encode($this->returnData);
        $this->returnData = array();
    }

    /**
     * Method add, receives the item type.
     * @param $type
     * Throws exception if type is not provided.
     */
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
                case 'schedule':
                    $model->createSchedule($_POST);
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

    /**
     * Method edit, receives the item type.
     * @param $type
     * Throws exception if type is not provided.
     */
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
                case 'prices':
                    $model->editPrices($_POST);
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

    /**
     * Method change, receives the item type.
     * @param $type
     * Throws exception if type is not provided.
     * @param $action
     */
    public function order($action)
    {
        session_start();
        if (!empty($_POST)) {
            $model = new Actions();
            switch ($action) {
                case 'done':
                    $model->markOrderAsDone($_POST);
                    break;
                case 'prepared':
                    $model->markOrderAsPrepared($_POST);
                    break;
                case 'revert_prepared':
                    $model->unmarkOrderAsPrepared($_POST);
                    break;
                case 'delivered':
                    $model->markOrderAsDelivered($_POST);
                    break;
                case 'revert_delivered':
                    $model->unmarkOrderAsDelivered($_POST);
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

    /**
     * Method delete, receives the item type.
     * @param $type
     * Throws exception if type is not provided.
     */
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

    /**
     * Method add, receives the item type. Return HTML.
     * @param $format
     * @param $type
     * Throws exception if type is not provided.
     */
    public function get($format, $type)
    {
        session_start();
        $model = new Actions();
        switch ($format) {
            case 'json':
                switch ($type) {
                    case 'flavor':
                        $model->findFlavor($_POST);
                        break;
                    case 'filling':
                        $model->findFilling($_POST);
                        break;
                    case 'topping':
                        $model->findTopping($_POST);
                        break;
                    case 'container':
                        $model->findContainer($_POST);
                        break;
                    case 'prices':
                        $model->getPrices($_POST);
                        break;
                    case 'earnings':
                        $model->getEarnings($_POST);
                        break;
                    case 'quantity_orders':
                        $model->getQuantityOrders($_POST);
                        break;
                    default:
                        $this->returnData["success"] = false;
                        $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        break;
                }
                break;
            case 'box':
                switch ($type) {
                    case 'icecream':
                        $model->getIceCreamBox();
                        break;
                    case 'flavor':
                        $model->getFlavorBox();
                        break;
                    case 'filling':
                        $model->getFillingBox();
                        break;
                    case 'topping':
                        $model->getToppingBox();
                        break;
                    case 'container':
                        $model->getContainerBox();
                        break;
                    case 'current_orders':
                        $model->getOrdersBox();
                        break;
                    default:
                        $this->returnData["success"] = false;
                        $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        break;
                }
                break;
            case 'list':
                switch ($type) {
                    case 'account':
                        $model->getAccountList();
                        break;
                    case 'temp_account':
                        $model->getTempAccountList();
                        break;
                    case 'flavor':
                        $model->getFlavorList();
                        break;
                    case 'filling':
                        $model->getFillingList();
                        break;
                    case 'topping':
                        $model->getToppingList();
                        break;
                    case 'container':
                        $model->getContainerList();
                        break;
                    default:
                        $this->returnData["success"] = false;
                        $this->returnData["error"] = "El tipo no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        break;
                }
                break;
            default:
                $this->returnData["success"] = false;
                $this->returnData["error"] = "El formato no es válido, no sé puede llevar a cabo la acción, vuelva a intentar.";
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
                break;
        }
    }
}