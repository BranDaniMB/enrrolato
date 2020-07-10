<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
$reports = new Report();
include VIEWS_PATH . "inc/header.php";
?>
<header class="row">
    <div class="col-3">
    </div>
    <div class="col-6">
        <h2>Reportes</h2>
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
<div class="row m-3">
    <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-audit-tab" data-toggle="pill" href="#v-pills-audit" role="tab"
               aria-controls="v-pills-audit" aria-selected="true">Registro de auditoría</a>
            <a class="nav-link" id="v-pills-profits-tab" data-toggle="pill" href="#v-pills-profits" role="tab"
               aria-controls="v-pills-profits" aria-selected="false">Reportes por ganancias</a>
            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab"
               aria-controls="v-pills-orders" aria-selected="false">Reportes por # pedidos</a>
        </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-audit" role="tabpanel" aria-labelledby="v-pills-audit-tab">
                <ul class="list-group text-light">
                    <?php
                    echo $reports->getAudits();
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="v-pills-profits" role="tabpanel" aria-labelledby="v-pills-profits-tab">...
            </div>
            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">...
            </div>
        </div>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
