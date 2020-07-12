<?php

/**
 * Essential MVC Core
 * Class Core
 */
class Core
{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $url = $this->getURL();

        if (file_exists(CONTROLLER_PATH . ucwords($url[0]) . ".php")) {
            // Default driver is changed
            $this->currentController = ucwords($url[0]);
            // Unset to controller
            unset($url[0]);
        }
        // Get the new driver
        require_once CONTROLLER_PATH . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        // Check the method
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        // Get the parameters
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    /**
     * Returns the current url
     * @return false|string[]
     */
    public function getURL()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_STRING);
            $url = explode("/", $url);
            return $url;
        }
    }
}
