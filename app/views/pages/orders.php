<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<header class="row">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark col-12">
        <a class="navbar-brand" href="/enrrolato/pages/about/">Enrrolato</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/enrrolato/orders/">órdenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/ingredients/">Ingredientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/schedule/">Horarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/reports/">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/authentication/">Cuentas de usuario</a>
                </li>
            </ul>
            <div class="dropdown mr-6">
                <button class="btn btn-secondary dropdown-toggle" id="user-profile" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="user-profile-img" src="<?php echo $_SESSION["payload"]["picture"] ?>" width="40px"
                         height="40px"/>
                    <span id="user-profile-name"><?php echo ucfirst(strtolower($_SESSION["payload"]["given_name"])) ?></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="user-profile">
                    <button class="dropdown-item" type="button">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="orders-container row" id="orders-container">
    <?php
    $orderModel = new Order();
    echo $orderModel->getOrdersInQueue();
    ?>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="/enrrolato/js/orders.js"></script>
