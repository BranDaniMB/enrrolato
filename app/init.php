<?php
require_once "config/config.php";
require_once ROOT_PATH . "vendor/autoload.php";

date_default_timezone_set('America/Costa_Rica');

spl_autoload_register(function ($className) {
    require_once LIBRARIES_PATH . $className . ".php";
});