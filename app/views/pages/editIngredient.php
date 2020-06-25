<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Editando <?php echo $data['INGREDIENT']['name'] ?></h2>
<?php
switch ($data["TYPE"]) {
    case "flavor":
        ?>
        <form name="edit_ingredient_flavor" action="/action/edit/flavor" method="post">
            <input id="currentName" value="<?php echo $data['INGREDIENT']['name'] ?>" type="hidden" name="currentName" required/>
            <label>Nombre:
                <input id="name" value="<?php echo $data['INGREDIENT']['name'] ?>" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>Es licor:
                <input id="isLiqueur" type="checkbox" <?php echo $data['INGREDIENT']['isLiqueur'] == 1?'checked':''?> name="isLiqueur"></label>
            <label>Es especial:
                <input id="isSpecial" type="checkbox" <?php echo $data['INGREDIENT']['isSpecial'] == 1?'checked':''?> name="isSpecial"></label>
            <label>Es exclusivo:
                <input id="isExclusive" type="checkbox" <?php echo $data['INGREDIENT']['isExclusive'] == 1?'checked':''?> name="isExclusive"></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" <?php echo $data['INGREDIENT']['avaliable'] == 1?'checked':''?> name="avaliable"></label>
            <input type="submit" value="Guardar cambios">
        </form>
        <?php
        break;
    case "filling":
        ?>
        <form name="edit_ingredient_filling" action="/action/edit/filling" method="post">
            <input id="currentName" value="<?php echo $data['INGREDIENT']['name'] ?>" type="hidden" name="currentName" required/>
            <label>Nombre:
                <input id="name" value="<?php echo $data['INGREDIENT']['name'] ?>" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>Es exclusivo:
                <input id="isExclusive" type="checkbox" <?php echo $data['INGREDIENT']['isExclusive'] == 1?'checked':''?> name="isExclusive"></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" <?php echo $data['INGREDIENT']['avaliable'] == 1?'checked':''?> name="avaliable"></label>
            <input type="submit" value="Guardar cambios">
        </form>
        <?php
        break;
    case "topping":
        ?>
        <form name="edit_ingredient_topping" action="/action/edit/topping" method="post">
            <input id="currentName" value="<?php echo $data['INGREDIENT']['name'] ?>" type="hidden" name="currentName" required/>
            <label>Nombre:
                <input id="name" value="<?php echo $data['INGREDIENT']['name'] ?>" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" <?php echo $data['INGREDIENT']['avaliable'] == 1?'checked':''?> name="avaliable"></label>
            <input type="submit" value="Guardar cambios">
        </form>
        <?php
        break;
    case "container":
        ?>
        <form name="edit_ingredient_container" action="/action/edit/container" method="post">
            <input id="currentName" value="<?php echo $data['INGREDIENT']['name'] ?>" type="hidden" name="currentName" required/>
            <label>Nombre:
                <input id="name" value="<?php echo $data['INGREDIENT']['name'] ?>" type="text" name="name" pattern="[a-záéíóúñü'\s]+" title="El nombre debe estar en minúsculas y puede contener espacios." required></label>
            <label>¿Disponible?
                <input id="avaliable" type="checkbox" <?php echo $data['INGREDIENT']['avaliable'] == 1?'checked':''?> name="avaliable"></label>
            <input type="submit" value="Guardar cambios">
        </form>
        <?php
        break;
}
?>

<?php
include VIEWS_PATH . "inc/footer.php";
?>
