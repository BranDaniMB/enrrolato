<?php
include VIEWS_PATH . "inc/header.php";
?>
    <div id="error">
        <h3 id="error-title"><?php echo $_SESSION["ERROR_TITLE"] ?></h3>
        <p id="error-message"><?php echo $_SESSION["ERROR_MESSAGE"] ?></p>
    </div>
    <div class="main-buttons">
        <a class="primary-button" href="/enrrolato/authentication/login">Volver a intentar</a>
    </div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>