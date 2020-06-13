<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Heladería Enrrolato</h2>
<div class="main-buttons">
    <a class="primary-button" href="/orders/">Mirar las ordenes</a>
    <a class="primary-button" href="/ingredients/">Administrar ingredientes</a>
    <a class="primary-button" href="/schedule/">Administrar horarios</a>
    <a class="primary-button" href="/reports/">Generar reportes</a>
    <a class="primary-button" href="/authentication/">Cuentas autorizadas</a>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
</body>
</html>
