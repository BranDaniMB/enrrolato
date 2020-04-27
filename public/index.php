<?php
    require_once "../app/init.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
    <link rel="stylesheet/less" type="text/less" href="../public/css/main.less" />
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
    include "components/footer.php";
    ?>
</body>
</html>