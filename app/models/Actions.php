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
                'isLiqueur' => isset($POST['isLiqueur'])?'1':'0',
                'isSpecial' => isset($POST['isSpecial'])?'1':'0',
                'isExclusive' => isset($POST['isExclusive'])?'1':'0',
                'avaliable' => isset($POST['avaliable'])?'1':'0'
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