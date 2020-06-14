<?php


class Actions extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createFlavor($POST) {
        print_r($POST);
        $reference = $this->getReference('business/ingredients/flavors/' . $POST["name"]);
        try {
            $reference->set([
                'name' => $POST['name'],
                'isLiqueur' => $POST['isLiqueur'],
                'isSpecial' => $POST['isSpecial'],
                'isExclusive' => $POST['isExclusive'],
                'avaliable' => $POST['avaliable']
            ]);
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $_SESSION["ERROR_TITLE"] = "Error al agregar el sabor.";
            $_SESSION["ERROR_MESSAGE"] = "Ha sucedido un error al agregar el sabor.n/". $e->getMessage();
            header('Location: /systemerror');
        }
        return true;
    }

    public function createFilling($POST) {
        return true;
    }

    public function createTopping($POST) {
        return true;
    }

    public function createContainer($POST) {
        return true;
    }
}