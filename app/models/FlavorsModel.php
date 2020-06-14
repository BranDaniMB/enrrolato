<?php

class FlavorsModel extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getFlavors()
    {
        $reference = $this->getReference('business/ingredients/flavors');
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
        $flavorList = $this->getFlavors();
        $boxes = "";

        foreach ($flavorList as &$item) {
            $boxes .='<div class="ingredient-container">' .
                        '<p class="ingredient-name">' . $item["name"] . '</p>' .
                        '<p>¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u></p>' .
                        '<p>¿Sabor especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u></p>' .
                        '<p>¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u></p>' .
                        '<p>¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></p>' .
                        '<a class="ingredient-edit" href="/ingredients/edit/'. $item["name"] .'"><i class="material-icons">create</i></a>' .
                    '</div>';
        }

        return $boxes;
    }
}