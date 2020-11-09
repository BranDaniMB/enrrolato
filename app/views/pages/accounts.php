<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<!-- Modal de agregar una nueva cuenta -->
<div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccountModalLabel">Añadir una cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert" id="msgLoad">
                    Procesando solicitud...
                </div>
                <div class="alert alert-success text-center" role="alert" id="msgSuccess"></div>
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form id="addAccount" name="addAccount">
                    <div class="form-group">
                        <label for="email">Cuenta de Google:</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted text-center">La cuenta de correo debe ser de Google, además una vez agregada aquí, se debe de iniciar sesión con ella en la app, para terminar el proceso de autenticación.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addAccount" class="btn btn-info" value="Borrar formulario"/>
                <input type="submit" form="addAccount" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog"
     aria-labelledby="deleteConfirmModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Eliminar {account}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert" id="msgLoad">
                    Procesando solicitud...
                </div>
                <div class="alert alert-success text-center" role="alert" id="msgSuccess">
                    Se ha eliminado con éxito, puedes cerrar la ventana.
                </div>
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                Seguro que quieres eliminar este elemento, está acción no se puede revertir.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="delete-submit">Eliminar</button>
            </div>
        </div>
    </div>
</div>
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
                    <a class="nav-link" href="/enrrolato/reports/">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/enrrolato/authentication/">Cuentas de usuario</a>
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
        <h2>Cuentas autorizadas</h2>
    </div>
</header>
<div class="row">
    <div class="accounts-table text-center col-10">
        <div class="row title">
            <div class="col-12">Cuentas autorizadas</div>
        </div>
        <ul class="list-group" id="authAccounts">
            <?php
            $auth = new Account();
            echo $auth->getAuthenticationAccounts();
            ?>
        </ul>
        <div class="row title">
            <div class="col-12">Pendientes de autenticarse</div>
        </div>
        <ul class="list-group" id="tempAccounts">
            <?php
            echo $auth->getTempAccounts();
            ?>
        </ul>
        <div class="row title">
            <a class="col-12" data-toggle="modal" data-target="#addAccountModal">Agregar otra cuenta</a>
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
<script type="text/javascript" src="/enrrolato/js/jquery.serializejson.js"></script>
<!-- <script src="/enrrolato/js/offline.min.js"></script> -->
<script src="/enrrolato/js/accounts.js"></script>
