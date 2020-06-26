<?php

class Actions extends Base
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function createFlavor($POST)
    {
        $reference = $this->getReference(FLAVORS . '/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                    'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                    'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                    'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                ]);
            } else {
                throw new Exception("Ese sabor ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el sabor.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function createFilling($POST)
    {
        $reference = $this->getReference(FILLINGS . '/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                    'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                ]);
            } else {
                throw new Exception("Ese relleno ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el relleno.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el relleno.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el relleno.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function createTopping($POST)
    {
        $reference = $this->getReference(TOPPINGS . '/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                ]);
            } else {
                throw new Exception("Ese topping ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el topping.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el topping.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el topping.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function createContainer($POST)
    {
        $reference = $this->getReference(CONTAINERS . '/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                ]);
            } else {
                throw new Exception("Ese envase ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el envase.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el envase.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el envase.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function createTempAccount($POST)
    {
        $reference = $this->getReference(TEMP_ADMINS . "/" . md5($POST['email']));
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set($POST['email']);
                return true;
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar la cuenta.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar la cuenta.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/authentication/";
            header('Location: /appError');
            return false;
        }
    }

    public function editFlavor($POST)
    {
        $reference = $this->getReference(FLAVORS . '/' . $POST["currentName"]);
        try {
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
                } else {
                    $reference->set([
                        'name' => $POST['currentName'],
                        'isLiqueur' => isset($POST['isLiqueur']) ? '1' : '0',
                        'isSpecial' => isset($POST['isSpecial']) ? '1' : '0',
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                }
            } else {
                throw new Exception("Ese sabor no existe, por favor use la opción de añadir para agregarlo.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al editar el sabor.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function editFilling($POST)
    {
        $reference = $this->getReference(FILLINGS . '/' . $POST["currentName"]);
        try {
            if ($reference->getSnapshot()->exists()) {
                if ($POST["currentName"] != $POST["name"]) {
                    $reference->set(null);
                    $reference = $this->getReference(FILLINGS . '/' . $POST["name"]);
                    $reference->set([
                        'name' => $POST['name'],
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                } else {
                    $reference->set([
                        'name' => $POST['currentName'],
                        'isExclusive' => isset($POST['isExclusive']) ? '1' : '0',
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                }
            } else {
                throw new Exception("Ese relleno no existe, por favor use la opción de añadir para agregarlo.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el relleno.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al editar el relleno.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el relleno.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function editTopping($POST)
    {
        $reference = $this->getReference(TOPPINGS . '/' . $POST["currentName"]);
        try {
            if ($reference->getSnapshot()->exists()) {
                if ($POST["name"] != $POST["currentName"]) {
                    $reference->set(null);
                    $reference = $this->getReference(TOPPINGS . '/' . $POST["name"]);
                    $reference->set([
                        'name' => $POST['name'],
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                } else {
                    $reference->set([
                        'name' => $POST['currentName'],
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                }
            } else {
                throw new Exception("Ese topping no existe, por favor use la opción de añadir para agregarlo.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el topping.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al editar el topping.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el topping.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function editContainer($POST)
    {
        $reference = $this->getReference(CONTAINERS . '/' . $POST["currentName"]);
        try {
            if ($reference->getSnapshot()->exists()) {
                if ($POST["name"] != $POST["currentName"]) {
                    $reference->set(null);
                    $reference = $this->getReference(CONTAINERS . '/' . $POST["name"]);
                    $reference->set([
                        'name' => $POST['name'],
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                } else {
                    $reference->set([
                        'name' => $POST['currentName'],
                        'avaliable' => isset($POST['avaliable']) ? '1' : '0'
                    ]);
                }
            } else {
                throw new Exception("Ese envase no existe, por favor use la opción de añadir para agregarlo.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el envase.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al editar el envase.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        } catch (Exception $e) {
            $_SESSION["ERROR_TITLE"] = "Error al editar el envase.";
            $_SESSION["ERROR_MESSAGE"] = $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/ingredients/";
            header('Location: /appError');
            return false;
        }
    }

    public function deleteAccount($email)
    {
        $reference = $this->getReference(ADMINS);
        try {
            $accounts = $reference->getSnapshot()->getValue();
            if (count($accounts) > 1) {
                foreach ($accounts as $key => $value) {
                    if ($value == $email) {
                        $reference = $this->getReference(ADMINS . "/" . $key);
                        $reference->set(null);
                        return true;
                    }
                }
                return false;
            } else {
                $_SESSION["ERROR_TITLE"] = "Error al eliminar la cuenta.";
                $_SESSION["ERROR_MESSAGE"] = "No puedes eliminar está cuenta, ya que es la única existente, por razones de seguridad debe haber al menos una cuenta.";
                $_SESSION["ERROR_HREF"] = "/authentication/";
                header('Location: /appError');
                return false;
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al eliminar la cuenta.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al eliminar la cuenta.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/authentication/";
            header('Location: /appError');
            return false;
        }
    }

    public function deleteTempAccount($email)
    {
        $reference = $this->getReference(TEMP_ADMINS);
        try {
            $accounts = $reference->getSnapshot()->getValue();
            foreach ($accounts as $key => $value) {
                if ($value == $email) {
                    $reference = $this->getReference(TEMP_ADMINS . "/" . $key);
                    $reference->set(null);
                    return true;
                }
            }
            return false;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al eliminar la cuenta.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al eliminar la cuenta.\n" . $e->getMessage();
            $_SESSION["ERROR_HREF"] = "/authentication/";
            header('Location: /appError');
            return false;
        }
    }
}