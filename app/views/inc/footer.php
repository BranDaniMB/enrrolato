<footer class="row">
    <?php
    if (strcmp("Inicio | " . SITE_NAME, $data["TITLE"]) != 0 && isset($_SESSION["isValidLogin"])) {
        echo '<div class="float-left col-3"><a class="button" href="/" ">Pantalla de inicio</a></div>';
    } elseif (strcmp("Acerca de | " . SITE_NAME, $data["TITLE"]) == 0 && !isset($_SESSION["isValidLogin"])) {
        echo '<div class="float-left col-3"><a class="button" href="/enrrolato/authentication/login/" ">Regresar</a></div>';
    } else {
        echo '<div class="col-3"></div>';
    }
    echo '<div class="col-6"></div>';
    if (strcmp("Acerca de | " . SITE_NAME, $data["TITLE"]) != 0) {
        echo '<div class="float-right col-3"><a class="button float-right" href="/enrrolato/pages/about/">Acerca de</a></div>';
    }
    ?>
</footer>
</div>
</body>
</html>