<footer>
    <?php
    if (strcmp("Inicio | " . SITE_NAME, $data["TITLE"]) != 0 && isset($_SESSION["isValidLogin"])) {
        echo '<a class="button-left" href="/" ">Pantalla de inicio</a>';
    }
    if (strcmp("Acerca de | " . SITE_NAME, $data["TITLE"]) == 0 && !isset($_SESSION["isValidLogin"])) {
        echo '<a class="button-left" href="/authentication/login/" ">Regresar</a>';
    }
    if (strcmp("Acerca de | " . SITE_NAME, $data["TITLE"]) != 0) {
        echo '<a class="button-right" href="/pages/about/">Acerca de</a>';
    }
    ?>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>