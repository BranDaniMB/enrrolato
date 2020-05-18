<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_FOREVER;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Acerca de...</h2>
<h3 class="about-subtitle">Heladería Enrrolato</h3>
<div class="about-description-container">
    <p class="about-description">Cafetería, Bowls Saludables y Heladería Artesanal en Sarchí.
        <br/>Contactar a m.me/Enrrolato o llamar al 8302 6566.</p></div>
<h3 class="about-subtitle">Desarrolladores</h3>
<div class="about-description-container">
    <p class="about-description">Brandon Masís Bolaños
        <br/>E-mail: <a href="mailto:brandanimb@gmail.com">brandanimb@gmail.com</a>
        <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
    <p class="about-description">Mariana Salazar Castro
        <br/>E-mail: <a href="mailto:msmasaca@gmail.com">msmasaca@gmail.com</a>
        <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
    <p class="about-description">Brayan Barrantes Rodríguez
        <br/>E-mail: <a href="mailto:bbr3196@gmail.com">bbr3196@gmail.com</a>
        <br/>Informática Empresarial, Recinto de Grecia, UCR.</p>
</div>

<?php
include VIEWS_PATH . "inc/footer.php";
?>
