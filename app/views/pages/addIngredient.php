<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
    <h2>Agregar nuevo ingrediente</h2>
<?php
switch ($data["TYPE"]) {
    case "flavor":
        ?>
        <form name="add_ingredient_flavor" action="/action/add/flavor" method="post">
            <label for="name">Nombre:</label>
            <input id="name" type="text" name="name" required>
            <label for="isLiqueur">Es licor:</label>
            <input id="isLiqueur" type="checkbox" name="isLiqueur" required>
            <label for="isSpecial">Es especial:</label>
            <input id="isSpecial" type="checkbox" name="isSpecial" required>
            <label for="isExclusive">Es exclusivo:</label>
            <input id="isExclusive" type="checkbox" name="isExclusive" required>
            <label for="avaliable">¿Disponible?:</label>
            <input id="avaliable" type="checkbox" name="avaliable" required>
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "filling":
        ?>
        <form name="add_ingredient_filling" action="/action/add/filling" method="post">
            <label for="name">Nombre:</label>
            <input id="name" type="text" name="name" required>
            <label for="isExclusive">Es exclusivo:</label>
            <input id="isExclusive" type="checkbox" name="isExclusive">
            <label for="avaliable">¿Disponible?:</label>
            <input id="avaliable" type="checkbox" name="avaliable">
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "topping":
        ?>
        <form name="add_ingredient_topping" action="/action/add/topping" method="post">
            <label for="name">Nombre:</label>
            <input id="name" type="text" name="name" required>
            <label for="avaliable">¿Disponible?:</label>
            <input id="avaliable" type="checkbox" name="avaliable">
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "container":
        ?>
        <form name="add_ingredient_container" action="/action/add/container" method="post">
            <label for="name">Nombre:</label>
            <input id="name" type="text" name="name" required>
            <label for="avaliable">¿Disponible?:</label>
            <input id="avaliable" type="checkbox" name="avaliable">
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
}
?>

<?php
include VIEWS_PATH . "inc/footer.php";
?>