<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Editando <?php echo $data['FLAVOR'] ?></h2>
<?php echo $data['TYPE'] ?>

<?php
include VIEWS_PATH . "inc/footer.php";
?>
