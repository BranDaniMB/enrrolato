<footer>
    <?php
        if (strcmp( "Inicio | " . SITE_NAME, $data["TITLE"]) != 0 && isset($_SESSION["isValidLogin"])) {
            echo '<a class="button-left" href="/enrrolato/" ">Pantalla de inicio</a>';
        }
        if (strcmp( "Acerca de | " . SITE_NAME, $data["TITLE"]) == 0 && !isset($_SESSION["isValidLogin"])) {
            echo '<a class="button-left" href="/enrrolato/authentication/login/" ">Regresar</a>';
        }
        if (strcmp( "Acerca de | " . SITE_NAME, $data["TITLE"]) != 0) {
            echo '<a class="button-right" href="/enrrolato/pages/about/">Acerca de</a>';
        }
    ?>
</footer>
</body>
</html>