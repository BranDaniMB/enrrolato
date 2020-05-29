<?php
require_once "config/config.php";
require_once ROOT_PATH . "vendor/autoload.php";

spl_autoload_register(function ($className) {
    require_once LIBRARIES_PATH . $className . ".php";
});