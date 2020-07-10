<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_FOREVER;
include VIEWS_PATH . "inc/header.php";
?>
<header class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <h2>Acerca de...</h2>
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
    <h3 class="about-subtitle col-12">Heladería Enrrolato</h3>
    <div class="w-100"></div>
    <div class="about-description-container col-12">
        <p class="about-description">Cafetería, Bowls Saludables y Heladería Artesanal en Sarchí.
            <br/>Contactar a m.me/Enrrolato o llamar al 8302 6566.</p></div>
</div>
<div class="row">
    <h3 class="about-subtitle col-12">Desarrolladores</h3>
    <div class="w-100"></div>
    <div class="about-description-container justify-content-center col-12">
        <p class="about-description col-4">Brandon Masís Bolaños
            <br/>E-mail: <a href="mailto:brandanimb@gmail.com">brandanimb@gmail.com</a>
            <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
        <p class="about-description col-4">Mariana Salazar Castro
            <br/>E-mail: <a href="mailto:msmasaca@gmail.com">msmasaca@gmail.com</a>
            <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
        <p class="about-description col-4">Brayan Barrantes Rodríguez
            <br/>E-mail: <a href="mailto:bbr3196@gmail.com">bbr3196@gmail.com</a>
            <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
