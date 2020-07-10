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
        <form name="add_ingredient_flavor" action="/enrrolato/action/add/flavor" method="post">
            <label>Nombre:
                <input id="name" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>Es licor:
                <input id="isLiqueur" type="checkbox" name="isLiqueur"></label>
            <label>Es especial:
                <input id="isSpecial" type="checkbox" name="isSpecial"></label>
            <label>Es exclusivo:
                <input id="isExclusive" type="checkbox" name="isExclusive"></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" name="avaliable"></label>
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "filling":
        ?>
        <form name="add_ingredient_filling" action="/enrrolato/action/add/filling" method="post">
            <label>Nombre:
                <input id="name" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>Es exclusivo:
                <input id="isExclusive" type="checkbox" name="isExclusive"></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" name="avaliable"></label>
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "topping":
        ?>
        <form name="add_ingredient_topping" action="/enrrolato/action/add/topping" method="post">
            <label for="name">Nombre:
                <input id="name" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label for="avaliable">¿Disponible?
                <input id="avaliable" type="checkbox" name="avaliable"></label>
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
    case "container":
        ?>
        <form name="add_ingredient_container" action="/enrrolato/action/add/container" method="post">
            <label for="name">Nombre:
                <input id="name" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label for="avaliable">¿Disponible?
                <input id="avaliable" type="checkbox" name="avaliable"></label>
            <input type="submit" value="Agregar">
        </form>
        <?php
        break;
}
?>

<?php
include VIEWS_PATH . "inc/footer.php";
?>