<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2><?php echo $data["SUCCESS_ACTION"] ?></h2>
<div class="main-buttons">
    <?php
    switch ($data["TYPE"]) {
        case "flavor":
        case "filling":
        case "topping":
        case "container":
            switch ($data["ACTION"]) {
                case "add":
                    echo '<a class="primary-button" href="/enrrolato/ingredients/' . $data["ACTION"] .'/'. $data["TYPE"] . '">Agregar otro</a>';
                    break;
            }
            echo '<a class="primary-button" href="/enrrolato/ingredients/">Volver a ingredientes</a>';
            break;
        case "account":
            echo '<a class="primary-button" href="/enrrolato/authentication/">Volver al gestor de cuentas</a>';
            break;
        default:
            echo '<a class="primary-button" href="/enrrolato">Volver</a>';
            break;
    }
    unset($data);
    ?>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
