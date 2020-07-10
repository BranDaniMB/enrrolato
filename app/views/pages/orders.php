<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<header class="row">
    <div class="col-3">
        <div class="row m-3">
            <span id="guide-color-not-ready" class="col-5">En preparación</span>
            <span id="guide-color-ready" class="col-7">Listo pero no entregado</span>
        </div>
    </div>
    <div class="col-6">
        <h2>Órdenes en curso</h2>
    </div>
    <div class="col-3">
        <?php
        if ($_SESSION["ACCESS"] == AVAIL_CONNECT && isset($_SESSION["isValidLogin"])) {
            ?>
            <div id="user-profile">
                <img id="user-profile-img" src="<?php echo $_SESSION["payload"]["picture"] ?>" width="50px"
                     height="50px"/>
                <p id="user-profile-name"><?php echo strtolower($_SESSION["payload"]["given_name"]) ?></p>
                <a href="/enrrolato/authentication/logout/" id="user-profile-logout">Salir</a>
            </div>
            <?php
        }
        ?>
    </div>
</header>
<div class="orders-container">
    <div class="card text-white text-center">
        <div class="card-header">
            <h5 class="card-title">Ordenado por Brandon</h5>
            <h6 class="card-subtitle mb-2">30/06/20 - 16:39</h6>
        </div>
        <div id="order-1" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
                <li data-target="#order-1" data-slide-to="0" class="active"></li>
                <li data-target="#order-1" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-body">
                        <h5 class="card-title">Helado #1</h5>
                        <h6 class="card-subtitle mb-2">+18</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
                <div class="carousel-item">
                    <div class="card-body">
                        <h5 class="card-title">Helado #2</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
            </div>
            <a class="carousel-control-prev" href="#order-1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#order-1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-body">
            <a href="#" class="card-link button">Lista</a>
            <a href="#" class="card-link button">Entregada</a>
        </div>
    </div>
    <div class="card text-white text-center" style="width: 18rem;">
        <div class="card-header">
            <h5 class="card-title">Ordenado por Brandon</h5>
            <h6 class="card-subtitle mb-2">30/06/20 - 16:39</h6>
        </div>
        <div id="order-2" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
                <li data-target="#order-2" data-slide-to="0" class="active"></li>
                <li data-target="#order-2" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-body">
                        <h5 class="card-title">Helado #1</h5>
                        <h6 class="card-subtitle mb-2">+18</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
                <div class="carousel-item">
                    <div class="card-body">
                        <h5 class="card-title">Helado #2</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
            </div>
            <a class="carousel-control-prev" href="#order-2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#order-2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-body">
            <a href="#" class="card-link button">Lista</a>
            <a href="#" class="card-link button">Entregada</a>
        </div>
    </div>
    <div class="card text-white text-center" style="width: 18rem;">
        <div class="card-header">
            <h5 class="card-title">Ordenado por Brandon</h5>
            <h6 class="card-subtitle mb-2">30/06/20 - 16:39</h6>
        </div>
        <div id="order-3" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
                <li data-target="#order-3" data-slide-to="0" class="active"></li>
                <li data-target="#order-3" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-body">
                        <h5 class="card-title">Helado #1</h5>
                        <h6 class="card-subtitle mb-2">+18</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
                <div class="carousel-item">
                    <div class="card-body">
                        <h5 class="card-title">Helado #2</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
            </div>
            <a class="carousel-control-prev" href="#order-3" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#order-3" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-body">
            <a href="#" class="card-link button">Lista</a>
            <a href="#" class="card-link button">Entregada</a>
        </div>
    </div>
    <div class="card text-white text-center" style="width: 18rem;">
        <div class="card-header">
            <h5 class="card-title">Ordenado por Brandon</h5>
            <h6 class="card-subtitle mb-2">30/06/20 - 16:39</h6>
        </div>
        <div id="order-4" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
                <li data-target="#order-4" data-slide-to="0" class="active"></li>
                <li data-target="#order-4" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card-body">
                        <h5 class="card-title">Helado #1</h5>
                        <h6 class="card-subtitle mb-2">+18</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
                <div class="carousel-item">
                    <div class="card-body">
                        <h5 class="card-title">Helado #2</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Chocolate-Banano-Vainilla</li>
                        <li class="list-group-item">Caramelo</li>
                        <li class="list-group-item">Botonetas-Granola</li>
                        <li class="list-group-item">Cono</li>
                    </ul>
                </div>
            </div>
            <a class="carousel-control-prev" href="#order-4" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#order-4" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card-body">
            <a href="#" class="card-link button">Lista</a>
            <a href="#" class="card-link button">Entregada</a>
        </div>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
