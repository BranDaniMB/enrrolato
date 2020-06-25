<?php

class IngredientsModel extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getInfo($path)
    {
        $reference = $this->getReference($path)->orderByKey();
        try {
            $snapshot = $reference->getSnapshot();
            if ($snapshot->exists()) {
                return $snapshot->getValue();
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al acceder a la base de datos.";
            $_SESSION["ERROR_MESSAGE"] = "Hubo un error al recopilar los datos desde la base de datos.";
            header('Location: /systemerror');
        }
        return null;
    }

    public function definedIsValue($value) {
        switch ($value) {
            case 0:
                return 'No';
            case 1:
                return 'Sí';
            default:
                return 'Desconocido';
        }
    }

    public function createIceCreamBox() {
        $iceCreamList = $this->getInfo(ICECREAMS);
        if (!empty($iceCreamList)) {
            $boxes = "";
            foreach ($iceCreamList as &$item) {
                $boxes .='<div class="ingredient-container">' .
                    '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                    '<p>¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u></p>' .
                    '<p>¿Sabor especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u></p>' .
                    '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                    '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                    '<a class="ingredient-edit" href="/ingredients/edit/flavor/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay helados para mostrar.";
        }
    }

    public function createFlavorsBox() {
        $flavorList = $this->getInfo(FLAVORS);
        if (!empty($flavorList)) {
            $boxes = "";
            foreach ($flavorList as &$item) {
                $boxes .='<div class="ingredient-container">' .
                    '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                    '<p>¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u></p>' .
                    '<p>¿Sabor especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u></p>' .
                    '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                    '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                    '<a class="ingredient-edit" href="/ingredients/edit/flavor/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay sabores para mostrar.";
        }
    }

    public function createFillingBox() {
        $fillingList = $this->getInfo(FILLINGS);
        if (!empty($fillingList)) {
            $boxes = "";
            foreach ($fillingList as &$item) {
                $boxes .='<div class="ingredient-container">' .
                    '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                    '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                    '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                    '<a class="ingredient-edit" href="/ingredients/edit/filling/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay rellenos para mostrar.";
        }
    }

    public function createToppingBox() {
        $toppingList = $this->getInfo(TOPPINGS);
        if (!empty($toppingList)) {
            $boxes = "";
            foreach ($toppingList as &$item) {
                $boxes .='<div class="ingredient-container">' .
                    '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                    '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                    '<a class="ingredient-edit" href="/ingredients/edit/topping/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay toppings para mostrar.";
        }
    }

    public function createContainerBox() {
        $containerList = $this->getInfo(CONTAINERS);
        if (!empty($containerList)) {
            $boxes = "";
            foreach ($containerList as &$item) {
                $boxes .='<div class="ingredient-container">' .
                    '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                    '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                    '<a class="ingredient-edit" href="/ingredients/edit/container/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay envases para mostrar.";
        }
    }
}