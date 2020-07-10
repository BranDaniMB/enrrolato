<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<header class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <h2>Heladería Enrrolato</h2>
    </div>
    <div class="col-3">
        <?php
        if ($_SESSION["ACCESS"] == AVAIL_CONNECT && isset($_SESSION["isValidLogin"])) {
            ?>
            <div id="user-profile">
                <img id="user-profile-img" src="<?php echo $_SESSION["payload"]["picture"] ?>" width="50px"
                     height="50px"/>
                <p id="user-profile-name"><?php echo strtolower($_SESSION["payload"]["given_name"]) ?></p>
                <a href="/enrrolato/authentication/logout/" id="user-profile-logout">Salir</a>
            </div>
            <?php
        }
        ?>
    </div>
</header>
<div class="row">
    <div class="col-12">
        <a class="primary-button" href="/enrrolato/orders/">Mirar las ordenes</a>
    </div>
    <div class="w-100"></div>
    <div class="col-12">
        <a class="primary-button" href="/enrrolato/ingredients/">Administrar ingredientes</a>
    </div>
    <div class="w-100"></div>
    <div class="col-12">
        <a class="primary-button" href="/enrrolato/schedule/">Administrar horarios</a>
    </div>
    <div class="w-100"></div>
    <div class="col-12">
        <a class="primary-button" href="/enrrolato/reports/">Generar reportes</a>
    </div>
    <div class="w-100"></div>
    <div class="col-12">
        <a class="primary-button" href="/enrrolato/authentication/">Cuentas autorizadas</a>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
</body>
</html>
