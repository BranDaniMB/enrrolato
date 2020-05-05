<?php
$_SESSION["MODE"] = "LOGIN";
include VIEWS_PATH . "inc/header.php";
?>
<h2>Iniciar sesión con Google</h2>
<?php
$googleClient = new Google_Client();
$auth = new Account($googleClient);

if (isset($_SESSION["isValidLogin"])) {
    header('Location: /enrrolato/');
}

if (isset($_GET['code'])) {
    $_SESSION["access_token"] = $_GET['code'];
    $_SESSION["token_data"] = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

    $payload = $googleClient->verifyIdToken($_SESSION["token_data"]["id_token"]);
    $_SESSION["payload"] = $payload;

   if ($auth->authenticate($_SESSION["payload"]["sub"], $_SESSION["payload"]["email"]) == 1) {
       unset($_SESSION["access_token"]);
       $_SESSION["isValidLogin"] = true;
       header('Location: /enrrolato/');
   } else {
       unset($_SESSION["access_token"]);
       unset($_SESSION["token_data"]);
       $_SESSION["ERROR_TITLE"] = "Cuenta no autorizada";
       $_SESSION["ERROR_MESSAGE"] = "La cuenta de correo <u>" . $_SESSION["payload"]["email"] . "</u> no está autorizada a ingresar al sistema.";
       unset($_SESSION["payload"]);
       header('Location: /enrrolato/authentication/loginerror');
   }
}
?>
<a class="google-login" href="<?php echo $auth->getAuthUrl() ?>">
    <img alt="Cambiar imagen" onmouseout="this.src='/enrrolato/public/images/btn_google_signin_dark_normal_web@2x.png';" onmouseover="this.src='/enrrolato/public/images/btn_google_signin_dark_focus_web@2x.png';" src="/enrrolato/public/images/btn_google_signin_dark_normal_web@2x.png" />
</a>

<?php
include VIEWS_PATH . "inc/footer.php";
?>
