<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Inicio</title>
    <?php
    echo '<link rel="stylesheet/css" type="text/css" href="'. CSS_PATH .'main.css" />'
    ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
</head>
<body>
<h2>Heladería Enrrolato</h2>
<div class="main-buttons">
    <a class="primary-button" href="../app/views/pages/orders.php">Mirar las ordenes</a>
    <a class="primary-button">Modificar disponibilidad de ingredientes</a>
    <a class="primary-button">Suspender servicio</a>
    <a class="primary-button">Generar reportes</a>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
</body>
</html>
