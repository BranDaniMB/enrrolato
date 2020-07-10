<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Cuentas autorizadas</h2>
<table class="accounts-table">
    <tr>
        <th colspan="2">Cuentas autorizadas</th>
    </tr>
    <?php
    $auth = new Account();
    $accounts = $auth->getAuthenticationAccounts();

    foreach ($accounts as $key => $value) {
        echo "<tr>";
        echo "<td>$value</td>";
        echo "<td><a class='delete-button' href='/enrrolato/action/delete/account/". $value. "'><i class=\"material-icons\">delete</i></a></td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <th colspan="2">Pendientes de autenticarse</th>
    </tr>
    <?php
    $accounts = $auth->getTempAccounts();
    if (!is_null($accounts)) {
        foreach ($accounts as $key => $value) {
            echo "<tr>";
            echo "<td>$value</td>";
            echo "<td><a class='delete-button' href='/enrrolato/action/delete/temp_account/". $value. "'><i class=\"material-icons\">delete</i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan=\"2\">No hay cuentas por autentificar</td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <td colspan="2">
            <a href="/enrrolato/authentication/add">Agregar otra cuenta</a>
        </td>
    </tr>
</table>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
