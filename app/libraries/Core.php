<?php
class Core {
    protected $currentController = "pages";
    protected $currentMethod = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->getURL();
    }

    public function getURL() {
        echo $_GET["url"];
    }
}
