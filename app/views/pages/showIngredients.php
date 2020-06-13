<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Lista de ingredientes</h2>

<a id="add-ingredient-button" class="add-ingredient-button button-left" href="/ingredients/add">Añadir un ingrediente</a>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'sabores')" id="defaultOpen">Sabores</button>
    <button class="tablinks" onclick="openCity(event, 'jarabes')">Jarabes</button>
    <button class="tablinks" onclick="openCity(event, 'topping')">Topping's</button>
    <button class="tablinks" onclick="openCity(event, 'envases')">envases</button>
</div>
<?php
$modify = new FlavorsModel();
?>

<!-- Tab content -->
<div id="sabores" name="flavor" class="tabcontent">
    <div class="ingredients-container">
    <?php
    echo $modify->createFlavorsBox();
    ?>
    </div>
</div>

<div id="jarabes" name="filling" class="tabcontent">
    <p>Aquí los rellenos</p>
</div>

<div id="topping" name="topping" class="tabcontent">
    <p>Aquí los topping's</p>
</div>

<div id="envases" name="container" class="tabcontent">
    <p>Aquí los envases's</p>
</div>

<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
