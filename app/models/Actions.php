<?php

/**
 * MVC - Model
 * Class Actions
 * Database access
 */
class Actions extends Base
{
    private array $returnData = array();

    /**
     * Actions constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create IceCream, receives POST data from AJAX
     * @param $POST
     */
    public function createIceCream($POST)
    {
        try {
            if (isset($POST["name"], $POST["flavor"], $POST["filling"], $POST["topping"], $POST["container"])) {
                $reference = $this->getReference(ICE_CREAMS . '/' . $POST["name"]);
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set([
                        'name' => $POST['name'],
                        'flavor' => $POST['flavor'],
                        'filling' => $POST['filling'],
                        'topping' => $POST['topping'],
                        'container' => $POST['container'],
                        'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                        'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                        'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                    ]);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Helado agregado con éxito, ya puedes cerrar esta ventana.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('add', 'icecream', $POST['name']);
                } else {
                    throw new Exception("Ese helado ya existe, por favor use la opción de edición para modificar su contenido.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Flavor, receives POST data from AJAX
     * @param $POST
     */
    public function createFlavor($POST)
    {
        try {
            if (isset($POST["name"])) {
                $reference = $this->getReference(FLAVORS . '/' . $POST["name"]);
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set([
                        'name' => $POST['name'],
                        'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                        'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                        'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                    ]);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Sabor agregado con éxito, ya puedes cerrar esta ventana.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('add', 'flavor', $POST['name']);
                } else {
                    throw new Exception("Ese sabor ya existe, por favor use la opción de edición para modificar su contenido.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Filling, receives POST data from AJAX
     * @param $POST
     */
    public function createFilling($POST)
    {
        $reference = $this->getReference(FILLINGS . '/' . $POST["name"]);
        try {
            if (isset($POST["name"])) {
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set([
                        'name' => $POST['name'],
                        'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                        'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                    ]);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Relleno agregado con éxito, ya puedes cerrar esta ventana.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('add', 'filling', $POST['name']);
                } else {
                    throw new Exception("Ese relleno ya existe, por favor use la opción de edición para modificar su contenido.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Topping, receives POST data from AJAX
     * @param $POST
     */
    public function createTopping($POST)
    {
        $reference = $this->getReference(TOPPINGS . '/' . $POST["name"]);
        try {
            if (isset($POST["name"])) {
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set([
                        'name' => $POST['name'],
                        'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                        'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                    ]);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Topping agregado con éxito, ya puedes cerrar esta ventana.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('add', 'topping', $POST['name']);
                } else {
                    throw new Exception("Ese topping ya existe, por favor use la opción de edición para modificar su contenido.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Container, receives POST data from AJAX
     * @param $POST
     */
    public function createContainer($POST)
    {
        try {
            if (isset($POST["name"])) {
                $reference = $this->getReference(CONTAINERS . '/' . $POST["name"]);
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set([
                        'name' => $POST['name'],
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                        'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                    ]);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Envase agregado con éxito, ya puedes cerrar está ventana.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('add', 'container', $POST['name']);
                } else {
                    throw new Exception("Ese envase ya existe, por favor use la opción de edición para modificar su contenido.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Temp account, receives POST data from AJAX
     * @param $POST
     */
    public function createTempAccount($POST)
    {
        try {
            if (isset($POST['email'])) {
                $reference = $this->getReference(TEMP_ADMINS . "/" . md5($POST['email']));
                if (!$reference->getSnapshot()->exists()) {
                    $reference->set($POST['email']);
                }
                $this->returnData["success"] = true;
                $this->returnData["posted"] = "Cuenta temporal agregada.";
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
                $this->registerAudit('add', 'tempAccount', $POST['email']);
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Create Schedule, receives POST data from AJAX
     * @param $POST
     */
    public function createSchedule($POST)
    {
        try {
            if (isset($POST['title'], $POST['isActive'], $POST['isActive'], $POST['typeOfAvailability'], $POST['startTime'], $POST['endTime'], $POST['startDate'], $POST['repeat'])) {
                $reference = $this->getReference(SCHEDULES . "/" . $POST['title']);
                if (!$reference->getSnapshot()->exists()) {
                    if ($POST['repeat'] != 'personalized') {
                        $reference->set([
                            'isActive' => $POST['isActive'],
                            'typeOfAvailability' => $POST['typeOfAvailability'],
                            'startTime' => $POST['startTime'],
                            'endTime' => $POST['endTime'],
                            'startDate' => $POST['startDate'],
                            'endDate' => ($POST['endDate'] != "") ? $POST['endDate'] : 'false',
                            'repeat' => $POST['repeat']
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Horario agregado con éxito, ya puedes cerrar está ventana.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('add', 'schedule', $POST['title']);
                    } else {
                        $reference->set([
                            'isActive' => $POST['isActive'],
                            'typeOfAvailability' => $POST['typeOfAvailability'],
                            'startTime' => $POST['startTime'],
                            'endTime' => $POST['endTime'],
                            'startDate' => $POST['startDate'],
                            'endDate' => ($POST['endDate'] != "") ? $POST['endDate'] : 'false',
                            'repeat' => $POST['repeat'],
                            'days' => [
                                'repeat_monday' => isset($POST['repeat_monday']),
                                'repeat_tuesday' => isset($POST['repeat_tuesday']),
                                'repeat_wednesday' => isset($POST['repeat_wednesday']),
                                'repeat_thursday' => isset($POST['repeat_thursday']),
                                'repeat_friday' => isset($POST['repeat_friday']),
                                'repeat_saturday' => isset($POST['repeat_saturday']),
                                'repeat_sunday' => isset($POST['repeat_sunday']),
                            ]
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Horario agregado con éxito, ya puedes cerrar está ventana.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('add', 'schedule', $POST['title']);
                    }
                } else {
                    $this->returnData["success"] = false;
                    $this->returnData["error"] = 'Ya existe un horario con este título.';
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Mark order as prepared, receives POST data from AJAX
     * @param $POST
     */
    public function markOrderAsPrepared($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('prepared')->set(true);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Orden marcada como preparada.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Unmark order as prepared, receives POST data from AJAX
     * @param $POST
     */
    public function unmarkOrderAsPrepared($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('prepared')->set(false);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Orden desmarcada como preparada.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Mark order as delivered, receives POST data from AJAX
     * @param $POST
     */
    public function markOrderAsDelivered($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('delivered')->set(true);
                    $reference->getChild('prepared')->set(true);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Orden marcada como entregada.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Unmark order as delivered, receives POST data from AJAX
     * @param $POST
     */
    public function unmarkOrderAsDelivered($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('delivered')->set(false);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Orden desmarcada como entregada.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Mark order as done, receives POST data from AJAX
     * @param $POST
     */
    public function markOrderAsDone($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('done')->set(true);
                    $reference = $this->getReference(LAST_DONE_ORDER);
                    $reference->set($POST['ID']);
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Orden marcada como hecha.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Unmark order as done, receives POST data from AJAX
     * @param $POST
     */
    public function unmarkOrderAsDone($POST)
    {
        try {
            if (isset($POST["ID"])) {
                $reference = $this->getReference(ORDERS . '/' . $POST["ID"]);
                if ($reference->getSnapshot()->exists()) {
                    $reference->getChild('done')->set(true);
                    $this->returnData["success"] = false;
                    $this->returnData["posted"] = "Orden desmarcada como hecha.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                } else {
                    throw new Exception("La orden no existe.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Edit Flavor, receives POST data from AJAX
     * @param $POST
     */
    public function editFlavor($POST)
    {
        try {
            if (isset($POST["name"], $POST["currentName"])) {
                $reference = $this->getReference(FLAVORS . '/' . $POST["currentName"]);
                if ($reference->getSnapshot()->exists()) {
                    if ($POST['currentName'] != $POST['name']) {
                        $reference->set(null);
                        $reference = $this->getReference(FLAVORS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Sabor modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'flavor', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Sabor modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'flavor', $POST['name']);
                    }
                } else {
                    throw new Exception("Ese sabor no existe, por favor use la opción de añadir para agregarlo.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Edit Filling, receives POST data from AJAX
     * @param $POST
     */
    public function editFilling($POST)
    {
        try {
            if (isset($POST["name"], $POST["currentName"])) {
                $reference = $this->getReference(FILLINGS . '/' . $POST["currentName"]);
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["currentName"] != $POST["name"]) {
                        $reference->set(null);
                        $reference = $this->getReference(FILLINGS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Relleno modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'filling', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Relleno modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'filling', $POST['name']);
                    }
                } else {
                    throw new Exception("Ese relleno no existe, por favor use la opción de añadir para agregarlo.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Edit Topping, receives POST data from AJAX
     * @param $POST
     */
    public function editTopping($POST)
    {
        try {
            if (isset($POST["name"], $POST["currentName"])) {
                $reference = $this->getReference(TOPPINGS . '/' . $POST["currentName"]);
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["name"] != $POST["currentName"]) {
                        $reference->set(null);
                        $reference = $this->getReference(TOPPINGS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Topping modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'topping', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Topping modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'topping', $POST['name']);
                    }
                } else {
                    throw new Exception("Ese topping no existe, por favor use la opción de añadir para agregarlo.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Edit Container, receives POST data by AJAX
     * @param $POST
     */
    public function editContainer($POST)
    {
        try {
            $reference = $this->getReference(CONTAINERS . '/' . $POST["currentName"]);
            if (isset($POST["name"], $POST["currentName"])) {
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["name"] != $POST["currentName"]) {
                        $reference->set(null);
                        $reference = $this->getReference(CONTAINERS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Envase modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'container', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0',
                            'price' => ($POST['price'] != "") ? $POST['price'] : 'false'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "envase modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'container', $POST['name']);
                    }
                } else {
                    throw new Exception("Ese envase no existe, por favor use la opción de añadir para agregarlo.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Edit prices, receives POST data by AJAX
     * @param $POST
     */
    public function editPrices($POST)
    {
        try {
            $reference = $this->getReference(PRICES);
            if (isset($POST["regularPrice"],
                $POST["regularFlavorAmount"],
                $POST["regularFillingAmount"],
                $POST["regularToppingAmount"],
                $POST["regularExtraToppingPrice"],
                $POST["specialFlavorPrice"],
                $POST["liqueurFlavorPrice"],
                $POST["seasonIceCreamPrice"])) {
                $reference->set([
                    'regular_price' => $POST["regularPrice"],
                    'flavor_amount' => $POST["regularFlavorAmount"],
                    'filling_amount' => $POST["regularFillingAmount"],
                    'topping_amount' => $POST["regularToppingAmount"],
                    'extra_topping_price' => $POST["regularExtraToppingPrice"],
                    'special_flavor' => $POST["specialFlavorPrice"],
                    'liqueur_flavor' => $POST["liqueurFlavorPrice"],
                    'season_ice_cream' => $POST["seasonIceCreamPrice"]
                ]);
                $this->returnData["success"] = true;
                $this->returnData["posted"] = "Se ha modificado los precios con éxito.";
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
                $this->registerAudit('edit', 'prices', null);
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Account, receives POST data by AJAX
     * @param $POST
     */
    public function deleteAccount($POST)
    {
        try {
            if (isset($POST['email'])) {
                $reference = $this->getReference(ADMINS);
                if ($reference->getSnapshot()->exists()) {
                    $accounts = $reference->getSnapshot()->getValue();
                    if (count($accounts) > 1) {
                        foreach ($accounts as $key => $value) {
                            if ($value == $POST['email']) {
                                $reference = $this->getReference(ADMINS . "/" . $key);
                                $reference->set(null);
                                // Success
                                $this->returnData["success"] = true;
                                $this->returnData["posted"] = "Cuenta eliminada.";
                                echo "||$$||" . json_encode($this->returnData);
                                $this->returnData = array();
                                $this->registerAudit('delete', 'account', $POST['email']);
                            }
                        }
                    } else {
                        throw new Exception("No puedes eliminar está cuenta, ya que es la única existente, por razones de seguridad debe haber al menos una cuenta.");
                    }
                } else {
                    throw new Exception("Datos incompletos.");
                }
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Temp Account, receives POST data by AJAX
     * @param $POST
     */
    public function deleteTempAccount($POST)
    {
        try {
            if (isset($POST['email'])) {
                $reference = $this->getReference(TEMP_ADMINS . "/" . md5($POST['email']));
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Cuenta temporal eliminada.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'tempAccount', $POST['email']);
                } else {
                    throw new Exception("No existe esa cuenta.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete IceCream, receives POST data by AJAX
     * @param $POST
     */
    public function deleteIceCream($POST)
    {
        try {
            if (isset($POST['name'])) {
                $reference = $this->getReference(ICE_CREAMS . "/" . $POST['name']);
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Helado eliminado.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'icecream', $POST['name']);
                } else {
                    throw new Exception("No existe este helado.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Flavor, receives POST data by AJAX
     * @param $POST
     */
    public function deleteFlavor($POST)
    {
        try {
            if (isset($POST['name'])) {
                $reference = $this->getReference(FLAVORS . "/" . $POST['name']);
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Sabor eliminado.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'flavor', $POST['name']);
                } else {
                    throw new Exception("No existe este sabor.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Filling, receives POST data by AJAX
     * @param $POST
     */
    public function deleteFilling($POST)
    {
        try {
            if (isset($POST['name'])) {
                $reference = $this->getReference(FILLINGS . "/" . $POST['name']);
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Relleno eliminado.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'filling', $POST['name']);
                } else {
                    throw new Exception("No existe este relleno.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Topping, receives POST data by AJAX
     * @param $POST
     */
    public function deleteTopping($POST)
    {
        try {
            if (isset($POST['name'])) {
                $reference = $this->getReference(TOPPINGS . "/" . $POST['name']);
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Topping eliminado.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'topping', $POST['name']);
                } else {
                    throw new Exception("No existe este topping.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Delete Container, receives POST data by AJAX
     * @param $POST
     */
    public function deleteContainer($POST)
    {
        try {
            if (isset($POST['name'])) {
                $reference = $this->getReference(CONTAINERS . "/" . $POST['name']);
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    // Success
                    $this->returnData["success"] = true;
                    $this->returnData["posted"] = "Envase eliminado.";
                    echo "||$$||" . json_encode($this->returnData);
                    $this->returnData = array();
                    $this->registerAudit('delete', 'container', $POST['name']);
                } else {
                    throw new Exception("No existe este envase.");
                }
            } else {
                throw new Exception("Datos incompletos.");
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from flavor, return JSON
     * @param $POST
     */
    public function findFlavor($POST)
    {
        try {
            $reference = $this->getReference(FLAVORS . '/' . $POST['name']);
            if ($reference->getSnapshot()->exists()) {
                $this->returnData["success"] = true;
                $this->returnData["json"] = json_encode($reference->getSnapshot()->getValue());
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
            } else {
                throw new Exception("No existe este sabor.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from filling, return JSON
     * @param $POST
     */
    public function findFilling($POST)
    {
        try {
            $reference = $this->getReference(FILLINGS . '/' . $POST['name']);
            if ($reference->getSnapshot()->exists()) {
                $this->returnData["success"] = true;
                $this->returnData["json"] = json_encode($reference->getSnapshot()->getValue());
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
            } else {
                throw new Exception("No existe este relleno.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from topping, return JSON
     * @param $POST
     */
    public function findTopping($POST)
    {
        try {
            $reference = $this->getReference(TOPPINGS . '/' . $POST['name']);
            if ($reference->getSnapshot()->exists()) {
                $this->returnData["success"] = true;
                $this->returnData["json"] = json_encode($reference->getSnapshot()->getValue());
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
            } else {
                throw new Exception("No existe este topping.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from container, return JSON
     * @param $POST
     */
    public function findContainer($POST)
    {
        try {
            $reference = $this->getReference(CONTAINERS . '/' . $POST['name']);
            if ($reference->getSnapshot()->exists()) {
                $this->returnData["success"] = true;
                $this->returnData["json"] = json_encode($reference->getSnapshot()->getValue());
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
            } else {
                throw new Exception("No existe este envase.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from prices, return JSON
     * @param $POST
     */
    public function getPrices($POST)
    {
        try {
            $reference = $this->getReference(PRICES);
            if ($reference->getSnapshot()->exists()) {
                $this->returnData["success"] = true;
                $this->returnData["json"] = json_encode($reference->getSnapshot()->getValue());
                echo "||$$||" . json_encode($this->returnData);
                $this->returnData = array();
            } else {
                throw new Exception("No hay información acerca de los precios.");
            }
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from earnings, return JSON
     * @param $POST
     */
    public function getEarnings($POST)
    {
        try {
            require(MODELS_PATH . "Report.php");
            $report = new Report();
            $this->returnData["success"] = true;
            $this->returnData["json"] = json_encode($report->getEarnings($POST));
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info from earnings, return JSON
     * @param $POST
     */
    public function getQuantityOrders($POST)
    {
        try {
            require(MODELS_PATH . "Report.php");
            $report = new Report();
            $this->returnData["success"] = true;
            $this->returnData["json"] = json_encode($report->getQuantityOrders($POST));
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info IceCream, return HTML to AJAX
     */
    public function getIceCreamBox()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createIceCreamBox();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Flavors, return HTML to AJAX
     */
    public function getFlavorBox()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFlavorBox();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Filling, return HTML to AJAX
     */
    public function getFillingBox()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFillingBox();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Topping, return HTML to AJAX
     */
    public function getToppingBox()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createToppingBox();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Container, return HTML to AJAX
     */
    public function getContainerBox()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createContainerBox();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Container, return HTML to AJAX
     */
    public function getOrdersBox()
    {
        require(MODELS_PATH . "Order.php");
        $order = new Order();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $order->getOrdersInQueue();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info account list, return HTML to AJAX
     */
    public function getAccountList()
    {
        require(MODELS_PATH . "Account.php");
        $account = new Account();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $account->getAuthenticationAccounts();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info temp account list, return HTML to AJAX
     */
    public function getTempAccountList()
    {
        require(MODELS_PATH . "Account.php");
        $account = new Account();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $account->getTempAccounts();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }


    /**
     * Get info Flavor list to create IceCream, return HTML to AJAX
     */
    public function getFlavorList()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFlavorList();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Filling list to create IceCream, return HTML to AJAX
     */
    public function getFillingList()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFillingList();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Topping list to create IceCream, return HTML to AJAX
     */
    public function getToppingList()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createToppingList();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }

    /**
     * Get info Container list to create IceCream, return HTML to AJAX
     */
    public function getContainerList()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createContainerList();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = "Error en la base de datos.";
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        } catch (Exception $e) {
            $this->returnData["success"] = false;
            $this->returnData["error"] = $e->getMessage();
            echo "||$$||" . json_encode($this->returnData);
            $this->returnData = array();
        }
    }
}