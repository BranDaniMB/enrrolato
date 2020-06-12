<?php

class ModifyAvailability extends Base
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
                print_r($snapshot->getValue());
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
        }
        $data = array('Mora' => array('name'=> 'Mora',
            'isLiqueur' => '0',
            'isSpecial' => '0',
            'isExclusive' => '0',
            'avaliable' => '1'));
        //$this->insertData('flavors', $data);
        return $data;
    }

    public function definedIsValue($value) {
        if ($value == 0) {
            return "No";
        } elseif ($value == 1) {
            return "Sí";
        } else {
            return "Desconocido";
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
                        '<a class="ingredient-edit"><i class="material-icons">create</i></a>' .
                    '</div>';
        }

        return $boxes;
    }
}