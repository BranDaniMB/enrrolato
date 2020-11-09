<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
$reports = new Report();
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
                    <a class="nav-link" href="/enrrolato/orders/">órdenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/ingredients/">Ingredientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/enrrolato/schedule/">Horarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/enrrolato/reports/">Reportes</a>
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
    <div class="col-12">
        <h2>Reportes</h2>
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
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Acción:</span>
                    </div>
                    <select class="custom-select" id="action-type" aria-label="Seleccionar el tipo de acción">
                        <option value="any" selected>cualquiera</option>
                        <?php
                        echo $reports->generateOptionsForActionTypes();
                        ?>
                    </select>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Objetivo:</span>
                    </div>
                    <select class="custom-select" id="objective-type" aria-label="Seleccionar el tipo de objetivo">
                        <option value="any" selected>todos</option>
                        <?php
                        echo $reports->generateOptionsForObjectsTypes();
                        ?>
                    </select>
                    <div class="input-group-prepend">
                        <label for="audit_startTime" class="input-group-text">De:</label>
                    </div>
                    <input type="date" class="form-control" id="audit_startTime" name="audit_startTime" required>
                    <div class="input-group-prepend">
                        <label for="audit_endTime" class="input-group-text">A:</label>
                    </div>
                    <input type="date" class="form-control" id="audit_endTime" name="audit_endTime" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="">Filtrar</button>
                    </div>
                </div>
                <ul class="list-group text-light" id="audit-list">
                    <?php
                    echo $reports->getAudits();
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="v-pills-profits" role="tabpanel" aria-labelledby="v-pills-profits-tab">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Gráfico:</span>
                    </div>
                    <select class="custom-select" id="earnings-chart-type" style="width: 100px;" aria-label="Example select with button addon">
                        <option value="line" selected>Linea</option>
                        <option value="bar">Barras</option>
                        <option value="radar">Radar</option>
                        <option value="pie">Pie</option>
                        <option value="doughnut">Doughnut</option>
                    </select>
                    <div class="input-group-prepend">
                        <label for="earnings_startTime" class="input-group-text">Inicio:</label>
                    </div>
                    <input type="date" class="form-control" id="earnings_startTime" name="earnings_startTime" required>
                    <div class="input-group-prepend">
                        <label for="earnings_endTime" class="input-group-text">Final:</label>
                    </div>
                    <input type="date" class="form-control" id="earnings_endTime" name="earnings_endTime" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="generateEarningsChart()">Actualizar</button>
                        <button class="btn btn-primary" type="button" onclick="printEarningsChart()">Descargar</button>
                    </div>
                </div>
                <div class="chart-container col-12">
                    <canvas id="earnings-report" style="background-color: #FFFFFF;"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Gráfico:</span>
                    </div>
                    <select class="custom-select" id="quantityOrders-chart-type" aria-label="Example select with button addon">
                        <option value="line" selected>Linea</option>
                        <option value="bar">Barras</option>
                        <option value="radar">Radar</option>
                        <option value="pie">Pie</option>
                        <option value="doughnut">Doughnut</option>
                    </select>
                    <div class="input-group-prepend">
                        <label for="quantityOrders_startTime" class="input-group-text">Inicio:</label>
                    </div>
                    <input type="date" class="form-control" id="quantityOrders_startTime" name="quantityOrders_startTime" required>
                    <div class="input-group-prepend">
                        <label for="quantityOrders_endTime" class="input-group-text">Final:</label>
                    </div>
                    <input type="date" class="form-control" id="quantityOrders_endTime" name="quantityOrders_endTime" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="generateQuantityOrdersChart()">Actualizar</button>
                        <button class="btn btn-primary" type="button" onclick="printQuantityOrdersChart()">Descargar</button>
                    </div>
                </div>
                <div class="chart-container col-12">
                    <canvas id="quantityOrders-report"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script src="/enrrolato/js/reports.js"></script>