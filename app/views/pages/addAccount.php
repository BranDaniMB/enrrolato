<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Cuentas autorizadas</h2>
<form name="add_account" action="/action/add/account" method="post">
    <label>Email:
        <input id="email" class="" type="email" name="email" required></label>
    <input type="submit" value="Agregar">
</form>
<small>La cuenta de correo debe ser de Google, además una vez agregada aquí, se debe de iniciar sesión con ella en la app,
    <br/>para terminar el proceso de autenticación.</small>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
