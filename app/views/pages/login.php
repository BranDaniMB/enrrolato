<?php
include VIEWS_PATH . "inc/header.php";
?>
<h2>Iniciar sesión con Google</h2>
<?php
$googleClient = new Google_Client();
$auth = new Account($googleClient);

if (isset($_SESSION["access_token"])) {
    header('Location: /enrrolato/');
}

if (isset($_GET['code'])) {
    $_SESSION["access_token"] = $_GET['code'];
    $_SESSION["token_data"] = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

    $payload = $googleClient->verifyIdToken($_SESSION["token_data"]["id_token"]);
    $_SESSION["payload"] = $payload;

    $auth->authenticate($_SESSION["payload"]["sup"], $_SESSION["payload"]["email"]);
    header('Location: /enrrolato/');
}
?>
<a class="google-login" href="<?php echo $auth->getAuthUrl() ?>">
    <img alt="Cambiar imagen" onmouseout="this.src='/enrrolato/public/images/btn_google_signin_dark_normal_web@2x.png';" onmouseover="this.src='/enrrolato/public/images/btn_google_signin_dark_focus_web@2x.png';" src="/enrrolato/public/images/btn_google_signin_dark_normal_web@2x.png" />
</a>

<?php
include VIEWS_PATH . "inc/footer.php";
?>
