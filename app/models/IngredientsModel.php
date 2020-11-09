<?php

/**
 * MVC - Model
 * Class IngredientsModel
 * Database Ingredients Model
 */
class IngredientsModel extends Base
{
    /**
     * IngredientsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return value from database reference
     * @param $path
     * @return mixed|null
     */
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
            header('Location: /appError');
        }
        return null;
    }

    /**
     * Returns a string according to the boolean configuration
     * @param $value
     * @return string
     */
    private function definedIsValue($value)
    {
        switch ($value) {
            case 0:
                return 'No';
            case 1:
                return 'Sí';
            default:
                return 'Desconocido';
        }
    }

    private function definedPrice($value)
    {
        if ($value != 'false') {
            return '₡' . $value;
        } else {
            return 'No posee precio personalizado.';
        }
    }

    private function sanitizeForID($text) {
        return str_replace(" ", "_", $text);
    }

    /**
     * Create the ice cream HTML boxes
     * @return string - HTML
     */
    public function createIceCreamBox()
    {
        $iceCreamList = $this->getInfo(ICE_CREAMS);
        if (!empty($iceCreamList)) {
            $boxes = "";
            foreach ($iceCreamList as &$item) {
                $boxes .= '<div class="card '. ($item["avaliable"]==1?'bg-success':'bg-warning') . ' font-weight-bold text-center ingredient-container" title="' . $this->sanitizeForID($item["name"]) .'" style="width: 300px;">' .
                    '<div class="card-header font-weight-bold">' . ucfirst($item["name"]) . '</div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#iceCream' . $this->sanitizeForID($item["name"]) . 'Flavor" role="button" aria-expanded="false"">Sabores<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="iceCream' . $this->sanitizeForID($item["name"]) . 'Flavor"><hr/>' . $item['flavor'] . '</div>' .
                    '</li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#iceCream' . $this->sanitizeForID($item["name"]) . 'Filling" role="button" aria-expanded="false">Rellenos<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="iceCream' . $this->sanitizeForID($item["name"]) . 'Filling"><hr/>' . $item['filling'] . '</div>' .
                    '</li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#iceCream' . $this->sanitizeForID($item["name"]) . 'Topping" role="button" aria-expanded="false">Toppings<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="iceCream' . $this->sanitizeForID($item["name"]) . 'Topping"><hr/>' . $item['topping'] . '</div>' .
                    '</li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#iceCream' . $this->sanitizeForID($item["name"]) . 'Container" role="button" aria-expanded="false">Envases<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="iceCream' . $this->sanitizeForID($item["name"]) . 'Container"><hr/>' . $item['container'] . '</div>' .
                    '</li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#iceCream' . $this->sanitizeForID($item["name"]) . 'Details" role="button" aria-expanded="false">Detalles<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="iceCream' . $this->sanitizeForID($item["name"]) . 'Details"><hr/>' .
                        '¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u><br/>' .
                        '¿Helado de temporada?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u><br/>' .
                        '¿Helado especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u><br/>' .
                        '¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u><br/>' .
                    '</div>' .
                    '</li>' .
                    '</ul>' .
                    '<div class="card-body row justify-content-around">' .
                    '<a class="col-6" onclick="deleteModal(\'icecream\',\'' . $item["name"] . '\')"><i class="material-icons">delete</i></a>' .
                    '</div>' .
                    '</div>';
            }
            return $boxes;
        } else {
            return "No hay helados para mostrar.";
        }
    }

    /**
     * Create the flavor HTML boxes
     * @return string - HTML
     */
    public function createFlavorBox()
    {
        $flavorList = $this->getInfo(FLAVORS);
        if (!empty($flavorList)) {
            $boxes = "";
            foreach ($flavorList as &$item) {
                $boxes .= '<div class="card '. ($item["avaliable"]==1?'bg-success':'bg-warning') .'  font-weight-bold text-center ingredient-container" title="' . $this->sanitizeForID($item["name"]) .'">' .
                    '<div class="card-header"><strong>' . ucfirst($item["name"]) . '</strong></div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#' . $this->sanitizeForID($item["name"]) . 'FlavorCollapse" role="button" aria-expanded="false">Otros detalles<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="' . $this->sanitizeForID($item["name"]) . 'FlavorCollapse"><hr/>' .
                        '¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u><br/>' .
                        '¿Sabor especial?: <u>' . $this->definedIsValue($item["isSpecial"]) . '</u><br/>' .
                        '¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u><br/>' .
                        'Precio: <u>' . $this->definedPrice($item["price"]) . '</u><br/>' .
                    '</div>' .
                    '</li>' .
                    '</ul>' .
                    '<div class="card-body row">' .
                    '<a class="col-6" onclick="modify(\'Flavor\',\'' . $item["name"] . '\')"><i class="material-icons">create</i></a>' .
                    '<a class="col-6" onclick="deleteModal(\'flavor\',\'' . $item["name"] . '\')"><i class="material-icons">delete</i></a>' .
                    '</div>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay sabores para mostrar.";
        }
    }

    /**
     * Create the filling HTML boxes
     * @return string -HTML
     */
    public function createFillingBox()
    {
        $fillingList = $this->getInfo(FILLINGS);
        if (!empty($fillingList)) {
            $boxes = "";
            foreach ($fillingList as &$item) {
                $boxes .= '<div class="card '. ($item["avaliable"]==1?'bg-success':'bg-warning') . ' font-weight-bold text-center ingredient-container" title="' . $this->sanitizeForID($item["name"]) .'">' .
                    '<div class="card-header"><strong>' . ucfirst($item["name"]) . '</strong></div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#' . $this->sanitizeForID($item["name"]) . 'FillingCollapse" role="button" aria-expanded="false">Otros detalles<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="' . $this->sanitizeForID($item["name"]) . 'FillingCollapse"><hr/>' .
                    '¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u><br/>' .
                    '¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u><br/>' .
                    'Precio: <u>' . $this->definedPrice($item["price"]) . '</u><br/>' .
                    '</div>' .
                    '</li>' .
                    '</ul>' .
                    '<div class="card-body row">' .
                    '<a class="col-6" onclick="modify(\'Filling\',\'' . $item["name"] . '\')"><i class="material-icons">create</i></a>' .
                    '<a class="col-6" onclick="deleteModal(\'filling\',\'' . $item["name"] . '\')"><i class="material-icons">delete</i></a>' .
                    '</div>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay rellenos para mostrar.";
        }
    }

    /**
     * Create the topping HTML boxes
     * @return string
     */
    public function createToppingBox()
    {
        $toppingList = $this->getInfo(TOPPINGS);
        if (!empty($toppingList)) {
            $boxes = "";
            foreach ($toppingList as &$item) {
                $boxes .= '<div class="card '. ($item["avaliable"]==1?'bg-success':'bg-warning') . ' font-weight-bold text-center ingredient-container" title="' . $this->sanitizeForID($item["name"]) .'">' .
                    '<div class="card-header"><strong>' . ucfirst($item["name"]) . '</strong></div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#' . $this->sanitizeForID($item["name"]) . 'ToppingCollapse" role="button" aria-expanded="false">Otros detalles<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="' . $this->sanitizeForID($item["name"]) . 'ToppingCollapse"><hr/>' .
                    '¿Es licor?: <u>' . $this->definedIsValue($item["isLiqueur"]) . '</u><br/>' .
                    '¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u><br/>' .
                    'Precio: <u>' . $this->definedPrice($item["price"]) . '</u><br/>' .
                    '</div>' .
                    '</li>' .
                    '</ul>' .
                    '<div class="card-body row">' .
                    '<a class="col-6" onclick="modify(\'Topping\',\'' . $item["name"] . '\')"><i class="material-icons">create</i></a>' .
                    '<a class="col-6" onclick="deleteModal(\'topping\',\'' . $item["name"] . '\')"><i class="material-icons">delete</i></a>' .
                    '</div>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay toppings para mostrar.";
        }
    }

    /**
     * Create the container HTML boxes
     * @return string - HTML
     */
    public function createContainerBox()
    {
        $containerList = $this->getInfo(CONTAINERS);
        if (!empty($containerList)) {
            $boxes = "";
            foreach ($containerList as &$item) {
                $boxes .= '<div class="card '. ($item["avaliable"]==1?'bg-success':'bg-warning') .' font-weight-bold text-center ingredient-container" title="' . $this->sanitizeForID($item["name"]) .'">' .
                    '<div class="card-header"><strong>' . ucfirst($item["name"]) . '</strong></div>' .
                    '<ul class="list-group list-group-flush">' .
                    '<li class="list-group-item">¿Esta disponible?: <u>' . $this->definedIsValue($item["avaliable"]) . '</u></li>' .
                    '<li class="list-group-item">' .
                    '<a class="font-weight-bold" data-toggle="collapse" href="#' . $this->sanitizeForID($item["name"]) . 'ContainerCollapse" role="button" aria-expanded="false">Otros detalles<br/><small>(click para mostrar)</small></a>' .
                    '<div class="collapse" id="' . $this->sanitizeForID($item["name"]) . 'ContainerCollapse"><hr/>' .
                    '¿Es exclusivo?: <u>' . $this->definedIsValue($item["isExclusive"]) . '</u><br/>' .
                    'Precio: <u>' . $this->definedPrice($item["price"]) . '</u><br/>' .
                    '</div>' .
                    '</li>' .
                    '</ul>' .
                    '<div class="card-body row">' .
                    '<a class="col-6" onclick="modify(\'Container\',\'' . $item["name"] . '\')"><i class="material-icons">create</i></a>' .
                    '<a class="col-6" onclick="deleteModal(\'container\',\'' . $item["name"] . '\')"><i class="material-icons">delete</i></a>' .
                    '</div>' .
                    '</div>';
            }

            return $boxes;
        } else {
            return "No hay envases para mostrar.";
        }
    }

    /**
     * Create the flavor HTML list
     * @return string - HTML
     */
    public function createFlavorList()
    {
        $flavorList = $this->getInfo(FLAVORS);
        if (!empty($flavorList)) {
            $boxes = "";
            $size = count($flavorList);
            if ($size % 2 == 0) {
                $break = $size / 2;
                $flag = false;
            } else {
                $break = ($size - 1) / 2;
                $flag = true;
            }
            $count = 0;
            foreach ($flavorList as &$item) {
                if ($count == 0) {
                    $boxes .= '<div class="col-6">';
                }
                $boxes .= '<div class="form-group form-check">' .
                    '<input type="checkbox" class="form-check-input" value="' . $item["name"] . '" id="iceCream_flavor_' . $item["name"] . '" name="iceCream_flavor_' . $item["name"] . '"/>' .
                    '<label class="form-check-label" for="iceCream_flavor_' . $item["name"] . '">' . $this->isExclusive($item["isExclusive"], $item["name"]) . '</label>' .
                    '</div>';

                $count++;
                if ($flag) {
                    if ($count == ($break + 1)) {
                        $count = 0;
                        $boxes .= '</div>';
                        $flag = false;
                    }
                } else {
                    if ($count == $break) {
                        $count = 0;
                        $boxes .= '</div>';
                    }
                }

            }
            return $boxes;
        } else {
            return "No hay sabores para mostrar.";
        }
    }

    /**
     * Create the filling HTML list
     * @return string - HTML
     */
    public function createFillingList()
    {
        $fillingList = $this->getInfo(FILLINGS);
        if (!empty($fillingList)) {
            $boxes = "";
            $size = count($fillingList);
            if ($size % 2 == 0) {
                $break = $size / 2;
                $flag = false;
            } else {
                $break = ($size - 1) / 2;
                $flag = true;
            }
            $count = 0;
            foreach ($fillingList as &$item) {
                if ($count == 0) {
                    $boxes .= '<div class="col-6">';
                }
                $boxes .= '<div class="form-group form-check">' .
                    '<input type="checkbox" class="form-check-input" value="' . $item["name"] . '" id="iceCream_filling_' . $item["name"] . '" name="iceCream_filling_' . $item["name"] . '"/>' .
                    '<label class="form-check-label" for="iceCream_filling_' . $item["name"] . '">' . $this->isExclusive($item["isExclusive"], $item["name"]) . '</label>' .
                    '</div>';

                $count++;
                if ($flag) {
                    if ($count == ($break + 1)) {
                        $count = 0;
                        $boxes .= '</div>';
                        $flag = false;
                    }
                } else {
                    if ($count == $break) {
                        $count = 0;
                        $boxes .= '</div>';
                    }
                }

            }
            return $boxes;
        } else {
            return "No hay rellenos para mostrar.";
        }
    }

    /**
     * Create the topping HTML list
     * @return string - HTML
     */
    public function createToppingList()
    {
        $toppingList = $this->getInfo(TOPPINGS);
        if (!empty($toppingList)) {
            $boxes = "";
            $size = count($toppingList);
            if ($size % 2 == 0) {
                $break = $size / 2;
                $flag = false;
            } else {
                $break = ($size - 1) / 2;
                $flag = true;
            }
            $count = 0;
            foreach ($toppingList as &$item) {
                if ($count == 0) {
                    $boxes .= '<div class="col-6">';
                }
                $boxes .= '<div class="form-group form-check">' .
                    '<input type="checkbox" class="form-check-input" value="' . $item["name"] . '" id="iceCream_topping_' . $item["name"] . '" name="iceCream_topping_' . $item["name"] . '"/>' .
                    '<label class="form-check-label" for="iceCream_topping_' . $item["name"] . '">' . $item["name"] . '</label>' .
                    '</div>';

                $count++;
                if ($flag) {
                    if ($count == ($break + 1)) {
                        $count = 0;
                        $boxes .= '</div>';
                        $flag = false;
                    }
                } else {
                    if ($count == $break) {
                        $count = 0;
                        $boxes .= '</div>';
                    }
                }

            }
            return $boxes;
        } else {
            return "No hay toppings para mostrar.";
        }
    }

    /**
     * Create the container HTML list
     * @return string - HTML
     */
    public function createContainerList()
    {
        $containerList = $this->getInfo(CONTAINERS);
        if (!empty($containerList)) {
            $boxes = "";
            $size = count($containerList);
            if ($size % 2 == 0) {
                $break = $size / 2;
                $flag = false;
            } else {
                $break = ($size - 1) / 2;
                $flag = true;
            }
            $count = 0;
            foreach ($containerList as &$item) {
                if ($count == 0) {
                    $boxes .= '<div class="col-6">';
                }
                $boxes .= '<div class="form-group form-check">' .
                    '<input type="checkbox" class="form-check-input" value="' . $item["name"] . '" id="iceCream_container_' . $item["name"] . '" name="iceCream_container_' . $item["name"] . '"/>' .
                    '<label class="form-check-label" for="iceCream_container_' . $item["name"] . '">' . $item["name"] . '</label>' .
                    '</div>';
                $count++;
                if ($flag) {
                    if ($count == ($break + 1)) {
                        $count = 0;
                        $boxes .= '</div>';
                        $flag = false;
                    }
                } else {
                    if ($count == $break) {
                        $count = 0;
                        $boxes .= '</div>';
                    }
                }

            }
            return $boxes;
        } else {
            return "No hay envases para mostrar.";
        }
    }

    /**
     * Accentuates the text if it is exclusive
     * @param $bool
     * @param $value
     * @return string
     */
    private function isExclusive($bool, $value)
    {
        if ($bool == 1) {
            return '<strong>' . $value . '</strong>';
        } else {
            return $value;
        }
    }
}