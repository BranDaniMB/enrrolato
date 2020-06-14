<?php

class IngredientsModel extends Base
{
    private $boxes = "";
    public function __construct()
    {
        parent::__construct();
    }

    public function getInfo($path)
    {
        $reference = $this->getReference($path);
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

    public function createFlavorsBox() {
        $flavorList = $this->getInfo('business/ingredients/flavors');


        foreach ($flavorList as &$item) {
            $this->boxes .='<div class="ingredient-container">' .
                        '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                        '<p>¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u></p>' .
                        '<p>¿Sabor especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u></p>' .
                        '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                        '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                        '<a class="ingredient-edit" href="/ingredients/edit/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
        }

        return $this->boxes;
    }

    public function createFillingBox() {
        $fillingList = $this->getInfo('business/ingredients/fillings');

        foreach ($fillingList as &$item) {
            $this->boxes .='<div class="ingredient-container">' .
                '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                '<a class="ingredient-edit" href="/ingredients/edit/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                '</div>';
        }

        return $this->boxes;
    }

    public function createToppingBox() {
        $toppingList = $this->getInfo('business/ingredients/toppings');

        foreach ($toppingList as &$item) {
            $this->boxes .='<div class="ingredient-container">' .
                '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                '<a class="ingredient-edit" href="/ingredients/edit/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                '</div>';
        }

        return $this->boxes;
    }

    public function createContainerBox() {
        $containerList = $this->getInfo('business/ingredients/containers');

        foreach ($containerList as &$item) {
            $this->boxes .='<div class="ingredient-container">' .
                '<p class="ingredient-name">' . ucfirst($item["name"]) . '</p>' .
                '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                '<a class="ingredient-edit" href="/ingredients/edit/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                '</div>';
        }

        return $this->boxes;
    }
}