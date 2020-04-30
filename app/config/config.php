<?php
define('ROOT_PATH', dirname(dirname(dirname(__FILE__))) . "/");
define('APP_PATH', ROOT_PATH . "app/");
define('PUBLIC_PATH', ROOT_PATH . "public/");
define('CONTROLLER_PATH', APP_PATH .'controllers/');
define('MODELS_PATH', APP_PATH .'models/');
define('COMPILERS_PATH', APP_PATH . 'compilers/');
define('CONFIG_PATH', APP_PATH .'config/');
define('HELPERS_PATH', APP_PATH .'helpers/');
define('LIBRARIES_PATH', APP_PATH .'libraries/');
define('VIEWS_PATH', APP_PATH .'views/');
define('CSS_PATH', PUBLIC_PATH .'css/');
define('IMAGES_PATH', PUBLIC_PATH .'images/');
define('JS_PATH', PUBLIC_PATH .'js/');

define('SITE_NAME', 'Enrrolato');

// Base de datos
define('DB_HOST', 'localhost');
define('UID', NULL);
define('PWD', NULL);
define('DB_NAME', 'Enrrolato');
