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
        <a class="primary-button" href="<?php echo isset($_SESSION["ERROR_HREF"])?$_SESSION["ERROR_HREF"]:'/'; ?>">Volver</a>
    </div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>