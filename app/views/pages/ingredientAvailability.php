<?php
include VIEWS_PATH . "inc/header.php";
?>
<h2>Disponibilidad de ingredientes</h2>
<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'sabores')" id="defaultOpen">Sabores</button>
    <button class="tablinks" onclick="openCity(event, 'jarabes')">Jarabes</button>
    <button class="tablinks" onclick="openCity(event, 'topping')">Topping's</button>
</div>

<!-- Tab content -->
<div id="sabores" class="tabcontent">
    <p>Aquí los sabores</p>
</div>

<div id="jarabes" class="tabcontent">
    <p>Aquí los rellenos</p>
</div>

<div id="topping" class="tabcontent">
    <p>Aquí los topping's</p>
</div>

<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
