<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="id=edge">
    <title><?php echo $data["TITLE"] ?></title>
    <!-- Scripts -->
    <script src="/js/offline.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>
    <!-- Styles -->
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
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDoK3cxz1ssywX3BPXUOnqn1ZEb0w0K2N8",
        authDomain: "enrrolato-1588267227733.firebaseapp.com",
        databaseURL: "https://enrrolato-1588267227733.firebaseio.com",
        projectId: "enrrolato-1588267227733",
        storageBucket: "enrrolato-1588267227733.appspot.com",
        messagingSenderId: "55283551393",
        appId: "1:55283551393:web:0ce7cda5eb6005a1f5b4e0",
        measurementId: "G-4Z0H0V2VXK"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>