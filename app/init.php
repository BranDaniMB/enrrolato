
<?php
    require_once "config/config.php";
    require_once "compilers/lessphp/lessc.inc.php";

    spl_autoload_register(function ($className) {
        require_once LIBRARIES_PATH . $className . ".php";
    });

    $less = new lessc;
    try {
        $less->checkedCompile(CSS_PATH."main.less", CSS_PATH."main.css");
    } catch (exception $e) {
        echo "fatal error: " . $e->getMessage();
    }