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
            if (isset($POST["name"]) && isset($POST["flavor"]) && isset($POST["filling"]) && isset($POST["topping"]) && isset($POST["container"])) {
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
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
     * Edit Flavor, receives POST data from AJAX
     * @param $POST
     */
    public function editFlavor($POST)
    {
        try {
            if (isset($POST["currentName"])) {
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
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
            if (isset($POST["currentName"])) {
                $reference = $this->getReference(FILLINGS . '/' . $POST["currentName"]);
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["currentName"] != $POST["name"]) {
                        $reference->set(null);
                        $reference = $this->getReference(FILLINGS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Relleno modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'filling', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
            if (isset($POST["currentName"])) {
                $reference = $this->getReference(TOPPINGS . '/' . $POST["currentName"]);
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["name"] != $POST["currentName"]) {
                        $reference->set(null);
                        $reference = $this->getReference(TOPPINGS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Topping modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'topping', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
            if (isset($POST["currentName"])) {
                if ($reference->getSnapshot()->exists()) {
                    if ($POST["name"] != $POST["currentName"]) {
                        $reference->set(null);
                        $reference = $this->getReference(CONTAINERS . '/' . $POST["name"]);
                        $reference->set([
                            'name' => $POST['name'],
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                        ]);
                        $this->returnData["success"] = true;
                        $this->returnData["posted"] = "Envase modificado.";
                        echo "||$$||" . json_encode($this->returnData);
                        $this->returnData = array();
                        $this->registerAudit('edit', 'container', $POST['name']);
                    } else {
                        $reference->set([
                            'name' => $POST['currentName'],
                            'avaliable' => isset($POST['avaliable']) ? '1' : '0'
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
     * Get info IceCream, return HTML to AJAX
     */
    public function getIceCream()
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
    public function getFlavors()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFlavorsBox();
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
    public function getFilling()
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
    public function getTopping()
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
    public function getContainer()
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
     * Get info Flavor list to create IceCream, return HTML to AJAX
     */
    public function getFlavorList()
    {
        require(MODELS_PATH . "IngredientsModel.php");
        $ingredients = new IngredientsModel();
        try {
            $this->returnData["success"] = true;
            $this->returnData["html"] = $ingredients->createFlavorsList();
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