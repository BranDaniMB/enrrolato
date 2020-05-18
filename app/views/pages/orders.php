<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<h2>Órdenes</h2>
<div class="guide-colors-container">
    <span id="guide-color-not-ready">En preparación</span>
    <span id="guide-color-ready">Listo pero no entregado</span>
</div>
<div class="orders-container">
    <div class="order not-ready adult">
        <h3>Ordenado por Brandon</h3>
        <p class="order-id">ID: 20200331.1103.30</p>
        <h4>Sabores</h4>
        <p class="order-flavors">Chocolate-Banano-Vainilla</p>
        <h4>Jarabe</h4>
        <p class="order-syrup">Caramelo</p>
        <h4>Topping</h4>
        <p class="order-topping">Botonetas-Granola</p>
        <p class="order-container">todo en cono.</p>
        <div class="container-buttons">
            <a class="button">Lista</a>
            <a class="button">Entregada</a>
        </div>
    </div>
    <div class="order ready">
        <h3>Ordenado por Brayan</h3>
        <p class="order-id">ID: 20200331.1103.30</p>
        <h4>Sabores</h4>
        <p class="order-flavors">Chocolate-Banano-Vainilla</p>
        <h4>Jarabe</h4>
        <p class="order-syrup">Caramelo</p>
        <h4>Topping</h4>
        <p class="order-topping">Botonetas-Granola</p>
        <p class="order-container">todo en cono.</p>
        <div class="container-buttons">
            <a class="button">Lista</a>
            <a class="button">Entregada</a>
        </div>
    </div>
    <div class="order not-ready adult">
        <h3>Ordenado por Mariana</h3>
        <p class="order-id">ID: 20200331.1103.30</p>
        <div class="icecream-container">
            <div class="icecream">
                <h4>Sabores</h4>
                <p class="order-flavors">Chocolate-Banano-Vainilla</p>
                <h4>Jarabe</h4>
                <p class="order-syrup">Caramelo</p>
                <h4>Topping</h4>
                <p class="order-topping">Botonetas-Granola</p>
                <p class="order-container">todo en cono.</p>
            </div>
            <div class="icecream">
                <h4>Sabores</h4>
                <p class="order-flavors">Chocolate-Banano-Vainilla</p>
                <h4>jarabe</h4>
                <p class="order-syrup">Caramelo</p>
                <h4>Topping</h4>
                <p class="order-topping">Botonetas-Granola</p>
                <p class="order-container">todo en cono.</p>
            </div>
        </div>
        <div class="container-buttons">
            <a class="button">Lista</a>
            <a class="button">Entregada</a>
        </div>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
