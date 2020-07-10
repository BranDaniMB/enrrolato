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
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="/enrrolato/js/jquery.serializejson.js"></script>
<!-- <script src="/enrrolato/js/offline.min.js"></script> -->
<script src="/enrrolato/js/main.js"></script>
</div>
</body>
</html>