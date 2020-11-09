<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
?>
<!-- Modal para agregar un horario -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Añadir un nuevo horario</h5>
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
                <form id="addSchedule" name="addSchedule">
                    <div class="form-group row">
                        <label for="addSchedule_name" class="col-sm-2 col-form-label">*Título:</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="addSchedule_name" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h6>*¿Este horario de disponibilidad está?</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isActive" id="addSchedule_isActive"
                                   value="true" required>
                            <label class="form-check-label" for="addSchedule_isActive_true">Activado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="isActive" id="addSchedule_isActive"
                                   value="false" required>
                            <label class="form-check-label" for="addSchedule_isActive_false">Desactivado</label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h6>*¿Durante este horario voy a estar?</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="typeOfAvailability"
                                   id="addSchedule_type" value="true" required>
                            <label class="form-check-label" for="addSchedule_type_1">Disponible</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="typeOfAvailability"
                                   id="addSchedule_type" value="false" required>
                            <label class="form-check-label" for="addSchedule_type_2">No disponible</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="addSchedule_startTime">*Hora de inicio:</label>
                            <input type="time" class="form-control" id="addSchedule_startTime" name="startTime"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="addSchedule_endTime">*Hola de finalización:</label>
                            <input type="time" class="form-control" id="addSchedule_endTime" name="endTime"
                                   required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="addSchedule_startDate">*Fecha de inicio:</label>
                            <input type="date" class="form-control" id="addSchedule_startDate" name="startDate"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="addSchedule_endDate">Fecha de finalización:</label>
                            <input type="date" class="form-control" id="addSchedule_endDate" name="endDate"
                                   aria-describedby="addSchedule_endDate_HelpBlock">
                            <small id="addSchedule_endDate_HelpBlock" class="form-text text-muted">
                                * Si no se define, se ejecutará sin fecha de finalización.
                            </small>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h6>*Repetir</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="repeat" id="addSchedule_repeat_1"
                                   value="only-one" required>
                            <label class="form-check-label" for="addSchedule_repeat_only_one">Una vez</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="repeat" id="addSchedule_repeat_2"
                                   value="daily" required>
                            <label class="form-check-label" for="addSchedule_repeat_daily">Diariamente</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="repeat" id="addSchedule_repeat_3"
                                   value="personalized" required>
                            <label class="form-check-label"
                                   for="addSchedule_repeat_personalized">Personalizado</label>
                        </div>
                    </div>
                    <div id="addSchedule_repeat_daysModal" class="form-group" style="display: none;">
                        <h6>*Seleccione los días de repetición:</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_monday"
                                   id="addSchedule_repeat_monday">
                            <label class="form-check-label" for="addSchedule_repeat_monday">Lunes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_tuesday"
                                   id="addSchedule_repeat_tuesday">
                            <label class="form-check-label" for="addSchedule_repeat_tuesday">Martes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_wednesday"
                                   id="addSchedule_repeat_wednesday">
                            <label class="form-check-label" for="addSchedule_repeat_wednesday">Miércoles</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_thursday"
                                   id="addSchedule_repeat_thursday">
                            <label class="form-check-label" for="addSchedule_repeat_thursday">Jueves</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_friday"
                                   id="addSchedule_repeat_friday">
                            <label class="form-check-label" for="addSchedule_repeat_friday">Viernes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_saturday"
                                   id="addSchedule_repeat_saturday">
                            <label class="form-check-label" for="addSchedule_repeat_saturday">Sábado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="repeat_sunday"
                                   id="addSchedule_repeat_sunday">
                            <label class="form-check-label" for="addSchedule_repeat_sunday">Domingo</label>
                        </div>
                    </div>
                </form>
                <small id="requiredInputsHelp" class="form-text text-muted">
                    * Estos campos son obligatorios.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="reset" form="addSchedule" class="btn btn-primary">Borrar formulario</button>
                <button type="submit" form="addSchedule" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Header -->
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
                    <a class="nav-link active" href="/enrrolato/schedule/">Horarios</a>
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
    <div class="col-3">
        <a id="float-left-button" class="button" data-toggle="modal"
           data-target="#addScheduleModal">Añadir un horario</a>
    </div>
    <div class="col-6">
        <h2>Horarios de disponibilidad</h2>
    </div>
</header>
<div class="row">

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
<script src="/enrrolato/js/schedules.js"></script>
