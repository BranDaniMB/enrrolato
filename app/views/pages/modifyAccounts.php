<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Cuentas autorizadas</h2>
<table class="accounts-table">
    <tr>
        <th colspan="2">Correo asociado</th>
    </tr>
    <?php
    $googleClient = new Google_Client();
    $auth = new Account($googleClient);

    $accounts = $auth->getAuthenticationAccounts();

    foreach ($accounts as $key => $value) {
        echo "<tr>";
        echo "<td>$value</td>";
        echo "<td><i class=\"material-icons\">delete</i></td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <th colspan="2">Para permitir otra cuenta, ingrese el correo aquí <i class="material-icons">arrow_downward</i></th>
    </tr>
    <tr>
        <form name="add_account" action="/action/add/account" method="post">
            <label>Nombre:
                <input id="email" type="email" name="email" required></label>
            <input type="submit" value="Agregar">
        </form>
    </tr>
</table>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
