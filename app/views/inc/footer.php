<footer>
    <?php
        if (strcmp( "Inicio | " . SITE_NAME, $data["TITLE"]) != 0) {
            echo '<a class="button-left" href="/enrrolato/" ">Pantalla de inicio</a>';
        }
    ?>
    <a class="button-right" href="#">Cerrar Sesión</a>
    <a class="button-right" href="/enrrolato/pages/about/">Acerca de</a>
</footer>
</body>
</html>