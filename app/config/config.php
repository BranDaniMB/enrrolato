<?php
define('ROOT_PATH', dirname(dirname(dirname(__FILE__))) . "/");
define('APP_PATH', ROOT_PATH . "app/");
define('PUBLIC_PATH', ROOT_PATH . "public/");
define('CONTROLLER_PATH', APP_PATH . 'controllers/');
define('MODELS_PATH', APP_PATH . 'models/');
define('COMPILERS_PATH', APP_PATH . 'compilers/');
define('CONFIG_PATH', APP_PATH . 'config/');
define('HELPERS_PATH', APP_PATH . 'helpers/');
define('LIBRARIES_PATH', APP_PATH . 'libraries/');
define('VIEWS_PATH', APP_PATH . 'views/');
define('CSS_PATH', PUBLIC_PATH . 'css/');
define('IMAGES_PATH', PUBLIC_PATH . 'images/');
define('JS_PATH', PUBLIC_PATH . 'js/');

define('SITE_NAME', 'Enrrolato');
define('AVAIL_CONNECT', 2);
define('AVAIL_DISCONNECT', 1);
define('AVAIL_FOREVER', 0);

// Firebase
define('GOOGLE_APPLICATION_CREDENTIALS', CONFIG_PATH . "enrrolato-1588267227733-firebase-adminsdk-mcd44-8adfedd088.json");
// Firebase references
// business/ingredients/flavors'
define('BUSINESS', 'business');
define('INGREDIENTS', BUSINESS.'/ingredients');
define('FLAVORS',INGREDIENTS.'/flavors');
define('FILLINGS',INGREDIENTS.'/fillings');
define('TOPPINGS',INGREDIENTS.'/toppings');
define('CONTAINERS',INGREDIENTS.'/containers');


