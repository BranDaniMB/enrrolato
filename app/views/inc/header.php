<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="id=edge">
    <!-- Title -->
    <title><?php echo $data["TITLE"] ?></title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="/enrrolato/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/enrrolato/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/enrrolato/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/enrrolato/images/favicon-16x16.png">
</head>
<body>
<div class="container-fluid">
    <?php
    // Verificación de la sesión
    if ($_SESSION["ACCESS"] == AVAIL_CONNECT && !isset($_SESSION["isValidLogin"])) {
        header('Location: /enrrolato/authentication/login/');
    } elseif ($_SESSION["ACCESS"] == AVAIL_DISCONNECT && isset($_SESSION["isValidLogin"])) {
        header('Location: /enrrolato');
    }
    ?>
