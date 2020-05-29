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
    $accounts = substr($accounts, 0, strlen($accounts)-1);
    $accounts = explode(",", $accounts);

    foreach ($accounts as &$account) {
        echo "<tr>";
        echo "<td>${account}</td>";
        echo "<td><i class=\"material-icons\">delete</i></td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <th colspan="2">Para permitir otra cuenta, inicie sesión con ella desde aquí abajo <i class="material-icons">arrow_downward</i></th>
    </tr>
    <tr>
        <td><a class="" href="<?php echo $auth->getAuthUrl() ?>">
                <img alt="Cambiar imagen" onmouseout="this.src='/images/btn_google_signin_dark_normal_web@2x.png';"
                     onmouseover="this.src='/images/btn_google_signin_dark_focus_web@2x.png';"
                     src="/images/btn_google_signin_dark_normal_web@2x.png"/>
            </a></td>
    </tr>
</table>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
