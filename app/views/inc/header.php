<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="id=edge">
    <!-- Title -->
    <title><?php echo $data["TITLE"] ?></title>
    <!-- Scripts -->
    <script src="/js/offline.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
</head>
<?php

if ($_SESSION["ACCESS"] == AVAIL_CONNECT && !isset($_SESSION["isValidLogin"])) {
    header('Location: /authentication/login/');
} elseif ($_SESSION["ACCESS"] == AVAIL_DISCONNECT && isset($_SESSION["isValidLogin"])) {
    header('Location: /');
} elseif ($_SESSION["ACCESS"] == AVAIL_CONNECT && isset($_SESSION["isValidLogin"])) {
    ?>
    <div id="user-profile">
        <img id="user-profile-img" src="<?php echo $_SESSION["payload"]["picture"] ?>" width="50px" height="50px"/>
        <p id="user-profile-name"><?php echo strtolower($_SESSION["payload"]["given_name"]) ?></p>
        <a href="/authentication/logout/" id="user-profile-logout">Cerrar sesión</a>
    </div>
    <?php
}
?>
<body>