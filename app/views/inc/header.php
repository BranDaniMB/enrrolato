<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="id=edge">
    <title><?php echo $data["TITLE"] ?></title>
    <!-- Scripts -->
    <script src="/enrrolato/public/js/offline.min.js"></script>
    <script src="/enrrolato/public/js/main.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/enrrolato/public/css/main.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/enrrolato/public/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/enrrolato/public/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/enrrolato/public/images/favicon-16x16.png">
</head>
<?php
    session_start();

    if (!isset($_SESSION["payload"]) && !isset($_GET['code'])) {
        if (strcmp( "Iniciar sesión | " . SITE_NAME, $data["TITLE"]) != 0
        && strcmp( "Acerca de | " . SITE_NAME, $data["TITLE"]) != 0) {
            header('Location: /enrrolato/authentication/login/');
        }
    }

    if (isset($_SESSION["payload"])) {
        ?>
        <div id="user-profile">
            <img id="user-profile-img" src="<?php echo $_SESSION["payload"]["picture"] ?>" width="50px" height="50px" />
            <p id="user-profile-name"><?php echo strtolower($_SESSION["payload"]["given_name"]) ?></p>
            <a href="/enrrolato/authentication/logout/" id="user-profile-logout">Cerrar sesión</a>
        </div>
        <?php
    }
?>
<body>