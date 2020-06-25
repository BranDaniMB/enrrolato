<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Lista de ingredientes</h2>

<a id="add-ingredient-button" class="add-ingredient-button button-left" href="/ingredients/add">Añadir un ingrediente</a>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'icecream')" id="defaultOpen">Helados</button>
    <button class="tablinks" onclick="openTab(event, 'flavor')">Sabores</button>
    <button class="tablinks" onclick="openTab(event, 'filling')">Jarabes</button>
    <button class="tablinks" onclick="openTab(event, 'topping')">Topping's</button>
    <button class="tablinks" onclick="openTab(event, 'container')">Envases</button>
</div>
<?php
$modify = new IngredientsModel();
?>

<!-- Tab content -->
<div id="icecream" class="tabcontent">
    <div class="ingredients-container">
        <?php
        echo $modify->createIceCreamBox();
        ?>
    </div>
</div>

<div id="flavor" class="tabcontent">
    <div class="ingredients-container">
    <?php
    echo $modify->createFlavorsBox();
    ?>
    </div>
</div>

<div id="filling" class="tabcontent">
    <div class="ingredients-container">
        <?php
        echo $modify->createFillingBox();
        ?>
    </div>
</div>

<div id="topping" class="tabcontent">
    <div class="ingredients-container">
        <?php
        echo $modify->createToppingBox();
        ?>
    </div>
</div>

<div id="container" class="tabcontent">
    <div class="ingredients-container">
        <?php
        echo $modify->createContainerBox();
        ?>
    </div>
</div>

<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
