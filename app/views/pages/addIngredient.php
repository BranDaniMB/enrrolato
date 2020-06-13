<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Agregar nuevo ingrediente</h2>
<?php
include VIEWS_PATH . "inc/footer.php";
?>