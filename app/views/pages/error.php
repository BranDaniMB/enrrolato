<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_FOREVER;
include VIEWS_PATH . "inc/header.php";
?>
    <div id="error">
        <h3 id="error-title"><?php echo $_SESSION["ERROR_TITLE"] ?></h3>
        <p id="error-message"><?php echo $_SESSION["ERROR_MESSAGE"] ?></p>
    </div>
    <div class="main-buttons">
        <a class="primary-button" href="/">Volver</a>
    </div>
<?php
unset($_SESSION["ERROR_TITLE"]);
unset($_SESSION["ERROR_MESSAGE"]);
?>
<?php
include VIEWS_PATH . "inc/footer.php";
?>