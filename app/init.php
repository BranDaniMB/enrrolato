
<?php
    require_once "config/dirs.php";
    require_once "libraries/Core.php";
    require_once "libraries/Controller.php";
    require_once "libraries/Database.php";
    require_once "compilers/lessphp/lessc.inc.php";



    $less = new lessc;
    try {
        $less->checkedCompile(CSS_PATH."main.less", CSS_PATH."main.css");
    } catch (exception $e) {
        echo "fatal error: " . $e->getMessage();
    }
    ?>