<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Heladería Enrrolato</h2>
<div class="main-buttons">
    <a class="primary-button" href="/enrrolato/orders/">Mirar las ordenes</a>
    <a class="primary-button" href="/enrrolato/availability/ingredients/">Modificar disponibilidad de ingredientes</a>
    <a class="primary-button" href="/enrrolato/availability/schedule/">Modificar disponibilidad de servicio</a>
    <a class="primary-button" href="/enrrolato/reports/">Generar reportes</a>
    <a class="primary-button" href="/enrrolato/authentication/">Cuentas autorizadas</a>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
</body>
</html>
