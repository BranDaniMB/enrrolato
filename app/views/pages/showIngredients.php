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
                <form name="IceCream_details" id="IceCream_details">
                    <div class="form-group">
                        <label for="iceCream_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="iceCream_name" name="name"
                               aria-describedby="iceCream_nameHelp" required>
                        <small id="iceCream_nameHelp" class="form-text text-muted">El nombre debe estar
                            en minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_isSpecial"
                               name="isSpecial">
                        <label class="form-check-label" for="iceCream_isSpecial">¿Es especial?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_isSeasonal"
                               name="isSeasonal">
                        <label class="form-check-label" for="iceCream_isSeasonal">¿Es de temporada?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_avaliable"
                               name="avaliable">
                        <label class="form-check-label" for="iceCream_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="addIceCream_price">Precio</label>
                        <input type="number" class="form-control" id="addIceCream_price" name="price"
                               aria-describedby="addIceCream_price_help">
                        <small id="addIceCream_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
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
                <form name="iceCream_flavors" id="iceCream_flavors">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_flavors"
                               name="any-flavors">
                        <label class="form-check-label" for="iceCream_any_flavors"
                               aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre
                            cualquiera
                            de los sabores no exclusivos.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los sabores disponibles para este helado:</h6>
                    <div id="iceCream_flavorsList" class="row">
                        <?php echo $modify->createFlavorList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info float-left" data-toggle="modal"
                        data-target="#addFlavorModal">Añadir un sabor
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step_flavor" form="iceCream_flavors">Siguiente
                </button>
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
                <form name="iceCream_filling" id="iceCream_filling">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_filling"
                               name="any-filling">
                        <label class="form-check-label" for="iceCream_any_filling"
                               aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre
                            cualquiera
                            de los rellenos no exclusivos.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los rellenos disponibles para este
                        helado:</h6>
                    <div id="iceCream_fillingList" class="row">
                        <?php echo $modify->createFillingList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info float-left" data-toggle="modal"
                        data-target="#addFillingModal">Añadir un relleno
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step_filling" form="iceCream_filling">Siguiente
                </button>
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
                <form name="iceCream_topping" id="iceCream_topping">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_topping"
                               name="any-topping">
                        <label class="form-check-label" for="iceCream_any_topping"
                               aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre
                            cualquiera
                            de los toppings.</small>
                    </div>
                    <hr/>
                    <h6 aria-describedby="iceCream_selectHelp">Elegir los toppings disponibles para este
                        helado:</h6>
                    <div id="iceCream_toppingList" class="row">
                        <?php echo $modify->createToppingList() ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info float-left" data-toggle="modal"
                        data-target="#addToppingModal">Añadir un topping
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="next-step_topping" form="iceCream_topping">Siguiente
                </button>
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
                <form name="iceCream_container" id="iceCream_container">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="iceCream_any_container"
                               name="any-container">
                        <label class="form-check-label" for="iceCream_any_container"
                               aria-describedby="iceCream_anyHelp">Permitir
                            cualquiera</label>
                        <small id="iceCream_anyHelp" class="form-text text-muted">*Se permitiría elegir entre
                            cualquiera
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
                <button type="button" class="btn btn-info float-left" data-toggle="modal"
                        data-target="#addContainerModal">Añadir un envase
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-dark" id="previous-step">Anterior</button>
                <button type="submit" class="btn btn-success" id="success_icecream" form="iceCream_container">Guardar
                </button>
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
<!-- Modales para agregar -->
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
                <form name="addIngredientFlavor" id="addIngredientFlavor">
                    <div class="form-group">
                        <label for="addIngredientFlavor_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
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
                               name="avaliable" checked>
                        <label class="form-check-label" for="addIngredientFlavor_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="addIngredientFlavor_price">Precio</label>
                        <input type="number" class="form-control" id="addIngredientFlavor_price" name="price"
                               aria-describedby="addIngredientFlavor_price_help" min="0">
                        <small id="addIngredientFlavor_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientFlavor" class="btn btn-info" value="Borrar formulario"/>
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
                <form name="addIngredientFilling" id="addIngredientFilling">
                    <div class="form-group">
                        <label for="addIngredientFilling_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="addIngredientFilling_name" name="name"
                               aria-describedby="addIngredientFilling_nameHelp" required>
                        <small id="addIngredientFilling_nameHelp" class="form-text text-muted">El nombre debe estar
                            en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFilling_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="addIngredientFilling_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFilling_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="addIngredientFilling_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientFilling_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="addIngredientFilling_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="addIngredientFilling_price">Precio</label>
                        <input type="number" class="form-control" id="addIngredientFilling_price" name="price"
                               aria-describedby="addIngredientFilling_price_help" min="0">
                        <small id="addIngredientFilling_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientFilling" class="btn btn-info" value="Borrar formulario"/>
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
                <form name="addIngredientTopping" id="addIngredientTopping">
                    <div class="form-group">
                        <label for="addIngredientTopping_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="addIngredientTopping_name" name="name"
                               aria-describedby="addIngredientTopping_nameHelp" required>
                        <small id="addIngredientTopping_nameHelp" class="form-text text-muted">El nombre debe estar
                            en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientTopping_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="addIngredientTopping_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientTopping_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="addIngredientTopping_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientTopping_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="addIngredientTopping_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="addIngredientTopping_price">Precio</label>
                        <input type="number" class="form-control" id="addIngredientTopping_price" name="price"
                               aria-describedby="addIngredientTopping_price_help" min="0">
                        <small id="addIngredientTopping_price" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientTopping" class="btn btn-info" value="Borrar formulario"/>
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
                <form name="addIngredientContainer" id="addIngredientContainer">
                    <div class="form-group">
                        <label for="addIngredientContainer_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="addIngredientContainer_name" name="name"
                               aria-describedby="addIngredientContainer_nameHelp" required>
                        <small id="addIngredientContainer_nameHelp" class="form-text text-muted">El nombre debe
                            estar en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientContainer_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="addIngredientContainer_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="addIngredientContainer_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="addIngredientContainer_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="addIngredientContainer_price">Precio</label>
                        <input type="number" class="form-control" id="addIngredientContainer_price" name="price"
                               aria-describedby="addIngredientContainer_price_help" min="0">
                        <small id="addIngredientContainer_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="addIngredientContainer" class="btn btn-info" value="Borrar formulario"/>
                <input type="submit" form="addIngredientContainer" class="btn btn-success" value="Agregar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modales para editar -->
<!-- Modal para editar un sabor -->
<div class="modal fade" id="editFlavorModal" tabindex="-1" role="dialog" aria-labelledby="editFlavorModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFlavorModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert" id="msgLoad">
                    Procesando solicitud...
                </div>
                <div class="alert alert-success text-center" role="alert" id="msgSuccess">
                    El sabor se ha modificado con éxito, puedes cerrar ésta ventana.
                </div>
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="editIngredientFlavor" id="editIngredientFlavor">
                    <div class="form-group">
                        <label for="editIngredientFlavor_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="editIngredientFlavor_name" name="name"
                               aria-describedby="editIngredientFlavor_nameHelp" required>
                        <small id="editIngredientFlavor_nameHelp" class="form-text text-muted">El nombre debe estar
                            en minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFlavor_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="editIngredientFlavor_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFlavor_isSpecial"
                               name="isSpecial">
                        <label class="form-check-label" for="editIngredientFlavor_isSpecial">¿Es especial?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFlavor_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="editIngredientFlavor_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFlavor_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="editIngredientFlavor_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="editIngredientFlavor_price">Precio</label>
                        <input type="number" class="form-control" id="editIngredientFlavor_price" name="price"
                               aria-describedby="editIngredientFlavor_price_help" min="0">
                        <small id="editIngredientFlavor_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" form="editIngredientFlavor" class="btn btn-success" value="Guardar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para editar un relleno -->
<div class="modal fade" id="editFillingModal" tabindex="-1" role="dialog" aria-labelledby="editFillingModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFillingModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary text-center" role="alert" id="msgLoad"></div>
                <div class="alert alert-success text-center" role="alert" id="msgSuccess"></div>
                <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
                <form name="editIngredientFilling" id="editIngredientFilling">
                    <div class="form-group">
                        <label for="editIngredientFilling_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="editIngredientFilling_name" name="name"
                               aria-describedby="editIngredientFilling_nameHelp" required>
                        <small id="editIngredientFilling_nameHelp" class="form-text text-muted">El nombre debe estar
                            en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFilling_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="editIngredientFilling_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFilling_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="editIngredientFilling_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientFilling_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="editIngredientFilling_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="editIngredientFilling_price">Precio</label>
                        <input type="number" class="form-control" id="editIngredientFilling_price" name="price"
                               aria-describedby="editIngredientFilling_price_help" min="0">
                        <small id="editIngredientFilling_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" form="editIngredientFilling" class="btn btn-success" value="Guardar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para editar un topping -->
<div class="modal fade" id="editToppingModal" tabindex="-1" role="dialog" aria-labelledby="editToppingModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editToppingModalLabel"></h5>
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
                <form name="editIngredientTopping" id="editIngredientTopping">
                    <div class="form-group">
                        <label for="editIngredientTopping_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="editIngredientTopping_name" name="name"
                               aria-describedby="editIngredientTopping_nameHelp" required>
                        <small id="editIngredientTopping_nameHelp" class="form-text text-muted">El nombre debe estar
                            en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientTopping_isLiqueur"
                               name="isLiqueur">
                        <label class="form-check-label" for="editIngredientTopping_isLiqueur">¿Es licor?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientTopping_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="editIngredientTopping_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientTopping_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="editIngredientTopping_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="editIngredientTopping_price">Precio</label>
                        <input type="number" class="form-control" id="editIngredientTopping_price" name="price"
                               aria-describedby="editIngredientTopping_price_help" min="0">
                        <small id="editIngredientTopping_price" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="editIngredientTopping" class="btn btn-info" value="Borrar formulario"/>
                <input type="submit" form="editIngredientTopping" class="btn btn-success" value="Guardar"/>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un envase -->
<div class="modal fade" id="editContainerModal" tabindex="-1" role="dialog"
     aria-labelledby="editContainerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContainerModalLabel"></h5>
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
                <form name="editIngredientContainer" id="editIngredientContainer">
                    <div class="form-group">
                        <label for="editIngredientContainer_name">Nombre</label>
                        <input type="text" pattern="^\S([a-záéíóúñü'\s]*\S)?$" class="form-control"
                               id="editIngredientContainer_name" name="name"
                               aria-describedby="editIngredientContainer_nameHelp" required>
                        <small id="editIngredientContainer_nameHelp" class="form-text text-muted">El nombre debe
                            estar en
                            minúsculas y puede contener espacios.</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientContainer_isExclusive"
                               name="isExclusive">
                        <label class="form-check-label" for="editIngredientContainer_isExclusive">¿Es
                            exclusivo?</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="editIngredientContainer_avaliable"
                               name="avaliable" checked>
                        <label class="form-check-label" for="editIngredientContainer_avaliable">¿Disponible?</label>
                    </div>
                    <div class="form-group">
                        <label for="editIngredientContainer_price">Precio</label>
                        <input type="number" class="form-control" id="editIngredientContainer_price" name="price"
                               aria-describedby="editIngredientContainer_price_help" min="0">
                        <small id="editIngredientContainer_price_help" class="form-text text-muted">Este campo no es
                            obligatorio, sino se define, se tomará desde la tabla de precios, según sus
                            características.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="reset" form="editIngredientContainer" class="btn btn-info" value="Borrar formulario"/>
                <input type="submit" form="editIngredientContainer" class="btn btn-success" value="Guardar"/>
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
                    <a class="nav-link active" href="/enrrolato/ingredients/">Ingredientes</a>
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
    <div class="col-3">
        <a id="add-ingredient-button" class="button" data-toggle="modal"
           data-target="#addIceCreamModal">Añadir un helado</a>
    </div>
    <div class="col-6">
        <h2>Lista de ingredientes</h2>
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
        <a class="nav-link" id="container-tab" onclick="setAddAction('Container')" data-toggle="pill"
           href="#container"
           role="tab" aria-controls="container" aria-selected="false">Envases</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="container-tab" data-toggle="pill"
           href="#prices"
           role="tab" aria-controls="prices" aria-selected="false">Precios</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="icecream" role="tabpanel">
        <div class="row justify-content-center align-items-center">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-light font-weight-bold" id="available-tip">Disponible</span>
                    <span class="input-group-text bg-warning text-dark font-weight-bold" id="not-available-tip">No disponible</span>
                    <span class="input-group-text bg-info text-light font-weight-bold" id="search-tip">Filtrar por nombre:</span>
                </div>
                <input type="text" class="form-control" id="search-iceCream" placeholder="nombre" aria-label="name" aria-describedby="search-tip">
            </div>
        </div>
        <div class="ingredients-container" id="icecreams-list">
            <?php
            echo $modify->createIceCreamBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="flavor" role="tabpanel">
        <div class="row justify-content-center align-items-center">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-light font-weight-bold" id="available-tip">Disponible</span>
                    <span class="input-group-text bg-warning text-dark font-weight-bold" id="not-available-tip">No disponible</span>
                    <span class="input-group-text bg-info text-light font-weight-bold" id="search-tip">Filtrar por nombre:</span>
                </div>
                <input type="text" class="form-control" id="search-flavor" placeholder="nombre" aria-label="name" aria-describedby="search-tip">
            </div>
        </div>
        <div class="ingredients-container" id="flavors-list">
            <?php
            echo $modify->createFlavorBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="filling" role="tabpanel">
        <div class="row justify-content-center align-items-center">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-light font-weight-bold" id="available-tip">Disponible</span>
                    <span class="input-group-text bg-warning text-dark font-weight-bold" id="not-available-tip">No disponible</span>
                    <span class="input-group-text bg-info text-light font-weight-bold" id="search-tip">Filtrar por nombre:</span>
                </div>
                <input type="text" class="form-control" id="search-filling" placeholder="nombre" aria-label="name" aria-describedby="search-tip">
            </div>
        </div>
        <div class="ingredients-container" id="fillings-list">
            <?php
            echo $modify->createFillingBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="topping" role="tabpanel">
        <div class="row justify-content-center align-items-center">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-light font-weight-bold" id="available-tip">Disponible</span>
                    <span class="input-group-text bg-warning text-dark font-weight-bold" id="not-available-tip">No disponible</span>
                    <span class="input-group-text bg-info text-light font-weight-bold" id="search-tip">Filtrar por nombre:</span>
                </div>
                <input type="text" class="form-control" id="search-topping" placeholder="nombre" aria-label="name" aria-describedby="search-tip">
            </div>
        </div>
        <div class="ingredients-container" id="toppings-list">
            <?php
            echo $modify->createToppingBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="container" role="tabpanel">
        <div class="row justify-content-center align-items-center">
            <div class="input-group mb-3 col-8">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-light font-weight-bold" id="available-tip">Disponible</span>
                    <span class="input-group-text bg-warning text-dark font-weight-bold" id="not-available-tip">No disponible</span>
                    <span class="input-group-text bg-info text-light font-weight-bold" id="search-tip">Filtrar por nombre:</span>
                </div>
                <input type="text" class="form-control" id="search-container" placeholder="nombre" aria-label="name" aria-describedby="search-tip">
            </div>
        </div>
        <div class="ingredients-container" id="containers-list">
            <?php
            echo $modify->createContainerBox();
            ?>
        </div>
    </div>
    <div class="tab-pane fade" id="prices" role="tabpanel">
        <div class="row justify-content-center">
            <div class="alert alert-primary text-center" role="alert" id="msgLoad">
                Procesando solicitud...
            </div>
            <div class="alert alert-success text-center" role="alert" id="msgSuccess"></div>
            <div class="alert alert-danger text-center" role="alert" id="msgError"></div>
            <form class="text-center text-light col-10 m-3" id="prices-form" name="prices-form">
                <label>Un helado regular tiene un precio de ₡ <input type="number" min="0" class="input-money"
                                                                     id="regularPrice" name="regularPrice" readonly
                                                                     required/>,
                    <br/> se compone de hasta <input type="number" min="0" class="input-amount" id="regularFlavorAmount"
                                                     name="regularFlavorAmount" readonly required/> sabores,
                    hasta <input type="number" min="0" class="input-amount" id="regularFillingAmount"
                                 name="regularFillingAmount" readonly required/> relleno(s) y
                    hasta <input type="number" min="0" class="input-amount" id="regularToppingAmount"
                                 name="regularToppingAmount" readonly required/> toppings.<br/>
                    Por cada topping extra se cobrará una suma de ₡ <input type="number" min="0" class="input-money"
                                                                           id="regularExtraToppingPrice"
                                                                           name="regularExtraToppingPrice" readonly
                                                                           required/>.<br/>
                    Si el helado contiene un sabor especial, que no es un licor tiene un precio de ₡ <input
                            type="number" min="0" class="input-money" id="specialFlavorPrice" name="specialFlavorPrice"
                            readonly required/>,<br/>
                    si contiene licor tiene un precio de ₡ <input type="number" min="0" class="input-money"
                                                                  id="liqueurFlavorPrice" name="liqueurFlavorPrice"
                                                                  readonly required/>.<br/>
                    Los helados de temporada tienen un precio de ₡ <input type="number" min="0" class="input-money"
                                                                          id="seasonIceCreamPrice"
                                                                          name="seasonIceCreamPrice" readonly required/>.
                </label>
            </form>
            <div class="w-100"></div>
            <button type="submit" form="prices-form" id="change-prices" value="0" class="button">Modificar</button>
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
<script src="/enrrolato/js/ingredients.js"></script>
