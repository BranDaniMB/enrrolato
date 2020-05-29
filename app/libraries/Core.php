<?php

class Core
{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();

        if (file_exists(CONTROLLER_PATH . ucwords($url[0]) . ".php")) {
            // Se cambia el controlador por defecto
            $this->currentController = ucwords($url[0]);
            // Unset a controlador
            unset($url[0]);
        }
        // Obtiene el nuevo controlador
        require_once CONTROLLER_PATH . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        // Verificar el metodo
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        // Obtener los parametros
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
