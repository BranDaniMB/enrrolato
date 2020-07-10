<?php
session_start();
$_SESSION["ACCESS"] = AVAIL_CONNECT;
include VIEWS_PATH . "inc/header.php";
$modify = new IngredientsModel();
?>
<!-- Modal para helados especiales -->
<!-- *** Modal para selección de detalles -->
<div class="modal fade" id="addIceCreamModal" tabindex="-1" role="dialog"
     aria-labelledby="iceCreamModal_detailsLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iceCreamModal_detailsLabel"><strong>Creación de helado especial o de
                        temporada</strong><br/>Selección
                    de detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="IceCream_details" id="IceCream_details" action="#" method="post">
                    <div class="form-group">
                        <label for="iceCream_name">Nombre</label>
                        <input type="text" pattern="[a-záéíóúñü'\s]+" class="form-control"
                               id="iceCream_name" name="name"
                               aria-describedby="iceCream_nameHelp" required>
                        <small id="iceCream_nameHelp" class="form-text text-muted">El nombre debe estar
                            en minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="iceCream_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_isSpecial"
                               name="isSpecial">
                        <label class="form-check-label" for="iceCream_isSpecial">¿Es especial?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="iceCream_avaliable">¿Disponible?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="next-step" form="IceCream_details">Siguiente
                </button>
            </div>
        </div>
    </div>
</div>
<!-- *** Modal para selección de sabores -->
<div class="modal fade" id="iceCreamModal_flavors" tabindex="-1" role="dialog"
     aria-labelledby="iceCreamModal_flavorsLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iceCreamModal_flavorsLabel"><strong>Creación de helado especial o de
                        temporada</strong><br/>Selección
                    de sabores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="iceCream_flavors" id="iceCream_flavors" method="post">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_flavors"
                               name="any-flavors">
                        <label class="form-check-label" for="iceCream_any_flavors" aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre cualquiera
                            de los sabores no exclusivos.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los sabores disponibles para este helado:</h6>
                    <div id="iceCream_flavorsList" class="row">
                        <?php echo $modify->createFlavorsList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step" form="iceCream_flavors">Siguiente</button>
            </div>
        </div>
    </div>
</div>
<!-- *** Modal para selección de rellenos -->
<div class="modal fade" id="iceCreamModal_filling" tabindex="-1" role="dialog"
     aria-labelledby="iceCreamModal_fillingLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iceCreamModal_fillingLabel"><strong>Creación de helado especial o de
                        temporada</strong><br/>Selección
                    de rellenos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="iceCream_filling" id="iceCream_filling" action="#" method="post">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_filling"
                               name="any-filling">
                        <label class="form-check-label" for="iceCream_any_filling" aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre cualquiera
                            de los rellenos no exclusivos.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los rellenos disponibles para este helado:</h6>
                    <div id="iceCream_fillingList" class="row">
                        <?php echo $modify->createFillingList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step" form="iceCream_filling">Siguiente</button>
            </div>
        </div>
    </div>
</div>
<!-- *** Modal para selección de toppings -->
<div class="modal fade" id="iceCreamModal_topping" tabindex="-1" role="dialog"
     aria-labelledby="iceCreamModal_toppingLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iceCreamModal_toppingLabel"><strong>Creación de helado especial o de
                        temporada</strong><br/>Selección
                    de toppings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="iceCream_topping" id="iceCream_topping" action="#" method="post">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_topping"
                               name="any-topping">
                        <label class="form-check-label" for="iceCream_any_topping" aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre cualquiera
                            de los toppings.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los toppings disponibles para este helado:</h6>
                    <div id="iceCream_toppingList" class="row">
                        <?php echo $modify->createToppingList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step" form="iceCream_topping">Siguiente</button>
            </div>
        </div>
    </div>
</div>
<!-- *** Modal para selección de container -->
<div class="modal fade" id="iceCreamModal_container" tabindex="-1" role="dialog"
     aria-labelledby="iceCreamModal_containerLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iceCreamModal_containerLabel"><strong>Creación de helado especial o de
                        temporada</strong><br/>Selección
                    de envases</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert" id="msgLoad">
                    Procesando solicitud...
                </div>
                <div class="alert alert-success text-center" role="alert" id="msgSuccess">
                    Se ha agregado el helado con éxito.
                </div>
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="iceCream_container" id="iceCream_container" action="#" method="post">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_container"
                               name="any-container">
                        <label class="form-check-label" for="iceCream_any_container" aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre cualquiera
                            de los envases.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los envases disponibles para este helado:</h6>
                    <div id="iceCream_containerList" class="row">
                        <?php echo $modify->createContainerList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="success" form="iceCream_container">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Eliminar {ingredient}</h5>
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
<!-- Modal para agregar un sabor -->
<div class="modal fade" id="addFlavorModal" tabindex="-1" role="dialog" aria-labelledby="addFlavorModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFlavorModalLabel">Añadir un sabor</h5>
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
                <form name="addIngredientFlavor" id="addIngredientFlavor" action="#" method="post">
                    <div class="form-group">
                        <label for="addIngredientFlavor_name">Nombre</label>
                        <input type="text" pattern="[a-záéíóúñü'\s]+" class="form-control"
                               id="addIngredientFlavor_name" name="name"
                               aria-describedby="addIngredientFlavor_nameHelp" required>
                        <small id="addIngredientFlavor_nameHelp" class="form-text text-muted">El nombre debe estar
                            en minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFlavor_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="addIngredientFlavor_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFlavor_isSpecial"
                               name="isSpecial">
                        <label class="form-check-label" for="addIngredientFlavor_isSpecial">¿Es especial?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFlavor_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="addIngredientFlavor_isExclusive">¿Es exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFlavor_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="addIngredientFlavor_avaliable">¿Disponible?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientFlavor" class="btn btn-primary" value="Borrar formulario"/>
                <input type="submit" form="addIngredientFlavor" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un relleno -->
<div class="modal fade" id="addFillingModal" tabindex="-1" role="dialog" aria-labelledby="addFillingModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFillingModalLabel">Añadir un jarabe</h5>
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
                <form name="addIngredientFilling" id="addIngredientFilling" action="#" method="post">
                    <div class="form-group">
                        <label for="addIngredientFilling_name">Nombre</label>
                        <input type="text" pattern="[a-záéíóúñü'\s]+" class="form-control"
                               id="addIngredientFilling_name" name="name"
                               aria-describedby="addIngredientFilling_nameHelp" required>
                        <small id="addIngredientFilling_nameHelp" class="form-text text-muted">El nombre debe estar en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFilling_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="addIngredientFilling_isExclusive">¿Es exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFilling_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="addIngredientFilling_avaliable">¿Disponible?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientFilling" class="btn btn-primary" value="Borrar formulario"/>
                <input type="submit" form="addIngredientFilling" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un topping -->
<div class="modal fade" id="addToppingModal" tabindex="-1" role="dialog" aria-labelledby="addToppingModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToppingModalLabel">Añadir un topping</h5>
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
                <form name="addIngredientTopping" id="addIngredientTopping" action="#" method="post">
                    <div class="form-group">
                        <label for="addIngredientTopping_name">Nombre</label>
                        <input type="text" pattern="[a-záéíóúñü'\s]+" class="form-control"
                               id="addIngredientTopping_name" name="name"
                               aria-describedby="addIngredientTopping_nameHelp" required>
                        <small id="addIngredientTopping_nameHelp" class="form-text text-muted">El nombre debe estar en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientTopping_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="addIngredientTopping_avaliable">¿Disponible?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientTopping" class="btn btn-primary" value="Borrar formulario"/>
                <input type="submit" form="addIngredientTopping" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un envase -->
<div class="modal fade" id="addContainerModal" tabindex="-1" role="dialog" aria-labelledby="addContainerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContainerModalLabel">Añadir un envase</h5>
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
                <form name="addIngredientContainer" id="addIngredientContainer" method="post">
                    <div class="form-group">
                        <label for="addIngredientContainer_name">Nombre</label>
                        <input type="text" pattern="[a-záéíóúñü'\s]+" class="form-control"
                               id="addIngredientContainer_name" name="name"
                               aria-describedby="addIngredientContainer_nameHelp" required>
                        <small id="addIngredientContainer_nameHelp" class="form-text text-muted">El nombre debe estar en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientContainer_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="addIngredientContainer_avaliable">¿Disponible?</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientContainer" class="btn btn-primary" value="Borrar formulario"/>
                <input type="submit" form="addIngredientContainer" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<header class="row">
    <div class="col-3">
        <a id="add-ingredient-button" class="add-ingredient-button button" data-toggle="modal"
           data-target="#addIceCreamModal">Añadir un helado</a>
    </div>
    <div class="col-6">
        <h2>Lista de ingredientes</h2>
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
<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="icecream-tab" onclick="setAddAction('IceCream')" data-toggle="pill"
           href="#icecream" role="tab" aria-controls="icecream" aria-selected="true">Helados</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="flavor-tab" onclick="setAddAction('Flavor')" data-toggle="pill" href="#flavor"
           role="tab" aria-controls="flavor" aria-selected="false">Sabores</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="filling-tab" onclick="setAddAction('Filling')" data-toggle="pill" href="#filling"
           role="tab" aria-controls="filling" aria-selected="false">Jarabes</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="topping-tab" onclick="setAddAction('Topping')" data-toggle="pill" href="#topping"
           role="tab" aria-controls="topping" aria-selected="false">Topping's</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="container-tab" onclick="setAddAction('Container')" data-toggle="pill" href="#container"
           role="tab" aria-controls="container" aria-selected="false">Envases</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="icecream" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="ingredients-container" id="icecreams-list">
            <?php
            echo $modify->createIceCreamBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="flavor" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="ingredients-container" id="flavors-list">
            <?php
            echo $modify->createFlavorsBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="filling" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="ingredients-container" id="fillings-list">
            <?php
            echo $modify->createFillingBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="topping" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="ingredients-container" id="toppings-list">
            <?php
            echo $modify->createToppingBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="container" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="ingredients-container" id="containers-list">
            <?php
            echo $modify->createContainerBox();
            ?>
        </div>
    </div>
</div>
<?php
include VIEWS_PATH . "inc/footer.php";
?>
