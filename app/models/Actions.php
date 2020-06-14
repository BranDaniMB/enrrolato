<?php

class Actions extends Base
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function createFlavor($POST) {
        $reference = $this->getReference('business/ingredients/flavors/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'isLiqueur' => isset($POST['isLiqueur'])?'1':'0',
                    'isSpecial' => isset($POST['isSpecial'])?'1':'0',
                    'isExclusive' => isset($POST['isExclusive'])?'1':'0',
                    'avaliable' => isset($POST['avaliable'])?'1':'0'
                ]);
            } else {
                throw new Exception("Ese sabor ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el sabor.\n". $e->getMessage();
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

    public function createFilling($POST) {
        $reference = $this->getReference('business/ingredients/fillings/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'isExclusive' => isset($POST['isExclusive'])?'1':'0',
                    'avaliable' => isset($POST['avaliable'])?'1':'0'
                ]);
            } else {
                throw new Exception("Ese relleno ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el relleno.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el relleno.\n". $e->getMessage();
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

    public function createTopping($POST) {
        $reference = $this->getReference('business/ingredients/toppings/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'avaliable' => isset($POST['avaliable'])?'1':'0'
                ]);
            } else {
                throw new Exception("Ese topping ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el topping.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el topping.\n". $e->getMessage();
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

    public function createContainer($POST) {
        $reference = $this->getReference('business/ingredients/containers/' . $POST["name"]);
        try {
            if (!$reference->getSnapshot()->exists()) {
                $reference->set([
                    'name' => $POST['name'],
                    'avaliable' => isset($POST['avaliable'])?'1':'0'
                ]);
            } else {
                throw new Exception("Ese envase ya existe, por favor use la opción de edición para modificar su contenido.");
            }
            return true;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el envase.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el envase.\n". $e->getMessage();
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
}