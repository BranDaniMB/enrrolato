/**
 * Page: showIngredients.php
 * Change the function of the upper left button
 * @param type
 */
function setAddAction(type) {
    const addButton = $('#add-ingredient-button');
    addButton.attr("data-target", "#add" + type + "Modal");
    switch (type.toLowerCase()) {
        case 'icecream':
            addButton.html("Agregar un helado");
            break;
        case 'flavor':
            addButton.html("Agregar un sabor");
            break;
        case 'filling':
            addButton.html("Agregar un jarabe");
            break;
        case 'topping':
            addButton.html("Agregar un topping");
            break;
        case 'container':
            addButton.html("Agregar un envase");
            break;
    }
}

/**
 * Page: showIngredients.php
 * Change the modal and AJAX modify
 * @param type
 * @param name
 */
function modify(type, name) {
    $('#edit' + type + 'ModalLabel').html('Modificando ' + name);
    const editForm = $('#editIngredient' + type);
    const editModal = $('#edit' + type + 'Modal');
    const msgLoad = $('#edit' + type + 'Modal #msgLoad');
    const msgError = $('#edit' + type + 'Modal #msgError');
    const msgSuccess = $('#edit' + type + 'Modal #msgSuccess');
    var data = undefined;

    editForm.trigger("reset");
    msgSuccess.css('display', 'none');
    msgError.css('display', 'none');
    editModal.modal('show');
    msgLoad.css('display', 'block');
    msgLoad.html('Cargando datos actuales del elemento...');

    $.post("/enrrolato/action/get/json/" + type.toLowerCase(), {name: name}, function (text) {
        let trash = text.split("||$$||")
        console.log(trash);
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            data = JSON.parse(response['json']);
            msgLoad.css('display', 'none');
            msgSuccess.html('Datos de ' + name + ' cargados.');
            msgSuccess.css('display', 'block');
        } else {
            msgLoad.css('display', 'none');
            msgError.html(response['error']);
            msgError.css('display', 'block');
            editModal.modal('show');
            return;
        }
    }, "text").done(function () {
        $('#editIngredient' + type + '_name').val(data['name']);
        $('#editIngredient' + type + '_isLiqueur').prop('checked', data['isLiqueur'] === '1');
        $('#editIngredient' + type + '_isSpecial').prop('checked', data['isSpecial'] === '1');
        $('#editIngredient' + type + '_isExclusive').prop('checked', data['isExclusive'] === '1');
        $('#editIngredient' + type + '_avaliable').prop('checked', data['avaliable'] === '1');

        editForm.off('submit');
        editForm.submit(function (e) {
            e.preventDefault();
            msgSuccess.css('display', 'none');
            msgError.css('display', 'none');
            msgLoad.html('Procesando solicitud...');
            msgLoad.css('display', 'block');
            var newData = editForm.serializeJSON();
            newData['currentName'] = data['name'];
            console.log(newData);
            $.post("/enrrolato/action/edit/" + type.toLowerCase(), newData, function (text) {
                let trash = text.split("||$$||")
                let response = JSON.parse(trash[1]);
                if (response['success']) {
                    msgLoad.css('display', 'none');
                    msgSuccess.html(name + ' se ha modificado con éxito, ya puedes cerrar está ventana.');
                    msgSuccess.css('display', 'block');
                } else {
                    msgLoad.css('display', 'none');
                    msgError.html(response['error']);
                    msgError.css('display', 'block');
                }
            }, "text").done(function () {
                updateIngredients(type.toLowerCase());
            }).fail(function () {
                alert("error");
            }).always(function () {
            });
        });
    }).fail(function () {
        alert("error");
    });
}

$('#deleteConfirmModal').on('show.bs.modal', function (event) {
    $('#deleteConfirmModal #msgLoad').css('display', 'none');
    $('#deleteConfirmModal #msgSuccess').css('display', 'none');
    $('#deleteConfirmModal #msgError').css('display', 'none');
})
$('#deleteConfirmModal').on('hidden.bs.modal', function (event) {
    $("#deleteConfirmModal #delete-submit").off("click");
})

/**
 * Page: showIngredients.php
 * Change the modal and AJAX to delete.
 * @param type
 * @param name
 */
function deleteModal(type, name) {
    const deleteModal = $('#deleteConfirmModal');
    const deleteSubmit = $("#deleteConfirmModal #delete-submit");
    const msgLoad = $('#deleteConfirmModal #msgLoad');
    const msgError = $('#deleteConfirmModal #msgError');
    const msgSuccess = $('#deleteConfirmModal #msgSuccess');

    deleteModal.find('.modal-title').text(("Eliminar {ingredient}").replace("{ingredient}", name));
    deleteModal.modal('show');
    deleteSubmit.off('click');
    deleteSubmit.click(function () {
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        $.post("/enrrolato/action/delete/" + type, {name: name}, function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
            } else {
                msgLoad.css('display', 'none');
                msgError.html(response['error']);
                msgError.css('display', 'block');
            }
        }, "text").done(function () {
            updateIngredients(type);
        }).fail(function () {
            alert("error");
        }).always(function () {
        });
    });
}

/**
 * Page: showIngredients.php
 * @param type
 */
function updateIngredients(type) {
    $.post("/enrrolato/action/get/box/" + type.toLowerCase(), {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        switch (type.toLowerCase()) {
            case 'icecream':
                $('#icecreams-list').html(response['html']);
                break;
            case 'flavor':
                $('#flavors-list').html(response['html']);
                break;
            case 'filling':
                $('#fillings-list').html(response['html']);
                break;
            case 'topping':
                $('#toppings-list').html(response['html']);
                break;
            case 'container':
                $('#containers-list').html(response['html']);
                break;
        }
    });
    $.post("/enrrolato/action/get/list/" + type.toLowerCase(), {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        switch (type.toLowerCase()) {
            case 'flavor':
                $('#iceCream_flavorsList').html(response['html']);
                break;
            case 'filling':
                $('#iceCream_fillingList').html(response['html']);
                break;
            case 'topping':
                $('#iceCream_toppingList').html(response['html']);
                break;
            case 'container':
                $('#iceCream_containerList').html(response['html']);
                break;
        }
    });
}

/**
 * Filter list
 */
function filterList(search, container) {
    let result;
    if (search.val().trim() !== "") {
        result = container.find('div.card:not(div[title*="' + search.val() +'"])');
        result.css('display','none');
        result = container.find('div.card[title*="' + search.val() +'"]');
        result.css('display','inline-block');
    } else {
        result = container.find('div.card');
        result.css('display','inline-block');
    }
}

/**
 * Page: showIngredients.php
 */
$(document).ready(function () {

    /**
     * Filter ice cream list
     */
    $('#search-iceCream').keyup(function(e) {
        filterList($('#search-iceCream'), $('#icecreams-list'));
    });

    /**
     * Filter flavor list
     */
    $('#search-flavor').keyup(function(e) {
        filterList($('#search-flavor'), $('#flavors-list'));
    });

    /**
     * Filter filling list
     */
    $('#search-filling').keyup(function(e) {
        filterList($('#search-filling'), $('#fillings-list'));
    });

    /**
     * Filter topping list
     */
    $('#search-topping').keyup(function(e) {
        filterList($('#search-topping'), $('#toppings-list'));
    });

    /**
     * Filter container list
     */
    $('#search-container').keyup(function(e) {
        filterList($('#search-container'), $('#containers-list'));
    });



    /**
     * Submit
     * Add flavor
     */
    $('#addIngredientFlavor').submit(function (e) {
        const msgLoad = $('#addFlavorModal #msgLoad');
        const msgError = $('#addFlavorModal #msgError');
        const msgSuccess = $('#addFlavorModal #msgSuccess');
        e.preventDefault();
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        const form = $('#addIngredientFlavor');
        $.post("/enrrolato/action/add/flavor", form.serializeJSON(), function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
                msgSuccess.html(response['posted']);
            } else {
                msgLoad.css('display', 'none');
                msgError.css('display', 'block');
                msgError.html(response['error']);
            }
        }, "text").done(function () {
            form.trigger("reset");
            updateIngredients('flavor');
        }).fail(function () {
            alert("error");
        }).always(function () {

        });
    });

    /**
     * Reset flavor messages
     */
    $('#addFlavorModal').on('show.bs.modal', function (event) {
        $('#addFlavorModal #msgLoad').css('display', 'none');
        $('#addFlavorModal #msgError').css('display', 'none');
        $('#addFlavorModal #msgSuccess').css('display', 'none');
    });

    /**
     * Submit
     * Add filling
     */
    $('#addIngredientFilling').submit(function (e) {
        const msgLoad = $('#addFillingModal #msgLoad');
        const msgError = $('#addFillingModal #msgError');
        const msgSuccess = $('#addFillingModal #msgSuccess');
        e.preventDefault();
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        const form = $('#addIngredientFilling');
        $.post("/enrrolato/action/add/filling", form.serializeJSON(), function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
                msgSuccess.html(response['posted']);
            } else {
                msgLoad.css('display', 'none');
                msgError.css('display', 'block');
                msgError.html(response['error']);
            }
        }, "text").done(function () {
            form.trigger("reset");
            updateIngredients('filling');
        }).fail(function () {
            alert("error");
        }).always(function () {
        });
    });

    /**
     * Reset filling messages
     */
    $('#addFillingModal').on('show.bs.modal', function (event) {
        $('#addFillingModal #msgLoad').css('display', 'none');
        $('#addFillingModal #msgError').css('display', 'none');
        $('#addFillingModal #msgSuccess').css('display', 'none');
    });

    /**
     * Submit
     * Add topping
     */
    $('#addIngredientTopping').submit(function (e) {
        const msgLoad = $('#addToppingModal #msgLoad');
        const msgError = $('#addToppingModal #msgError');
        const msgSuccess = $('#addToppingModal #msgSuccess');
        e.preventDefault();
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        const form = $('#addIngredientTopping')
        $.post("/enrrolato/action/add/topping", form.serializeJSON(), function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
                msgSuccess.html(response['posted']);
            } else {
                msgLoad.css('display', 'none');
                msgError.css('display', 'block');
                msgError.html(response['error']);
            }
        }, "text").done(function () {
            form.trigger("reset");
            updateIngredients('topping');
        }).fail(function () {
            alert("error");
        }).always(function () {

        });
    });

    /**
     * Reset topping messages
     */
    $('#addToppingModal').on('show.bs.modal', function (event) {
        $('#addToppingModal #msgLoad').css('display', 'none');
        $('#addToppingModal #msgError').css('display', 'none');
        $('#addToppingModal #msgSuccess').css('display', 'none');
    });

    /**
     * Submit
     * Add container
     */
    $('#addIngredientContainer').submit(function (e) {
        const msgLoad = $('#addContainerModal #msgLoad');
        const msgError = $('#addContainerModal #msgError');
        const msgSuccess = $('#addContainerModal #msgSuccess');
        e.preventDefault();
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        const form = $('#addIngredientContainer');
        $.post("/enrrolato/action/add/container", form.serializeJSON(), function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
                msgSuccess.html(response['posted']);
            } else {
                msgLoad.css('display', 'none');
                msgError.css('display', 'block');
                msgError.html(response['error']);
            }
        }, "text").done(function () {
            form.trigger("reset");
            updateIngredients('container');
        }).fail(function () {
            alert("error");
        }).always(function () {

        });
    });

    /**
     * Reset container messages
     */
    $('#addContainerModal').on('show.bs.modal', function (event) {
        $('#addContainerModal #msgLoad').css('display', 'none');
        $('#addContainerModal #msgError').css('display', 'none');
        $('#addContainerModal #msgSuccess').css('display', 'none');
    });

    /**
     * Create ice cream process
     */
    var processCurrentStep;
    var IceCream;

    /**
     * Start a process step
     * @param step
     */
    function initStep(step) {
        switch (step) {
            case 1:
                processCurrentStep = 1;
                $('#addIceCreamModal').modal('show');
                break;
            case 2:
                processCurrentStep = 2;
                $('#iceCreamModal_flavors').modal('show');
                break;
            case 3:
                processCurrentStep = 3;
                $('#iceCreamModal_filling').modal('show');
                break;
            case 4:
                processCurrentStep = 4;
                $('#iceCreamModal_topping').modal('show');
                break;
            case 5:
                processCurrentStep = 5;
                $('#iceCreamModal_container').modal('show');
                break;
        }
    }

    // Step 1
    $('#addIceCreamModal').on('shown.bs.modal', function (e) {
        if (processCurrentStep !== undefined && processCurrentStep !== 1) {
            $('#addIceCreamModal').modal('hide');
            initStep(processCurrentStep);
        }
    });
    $('#IceCream_details').submit(function (e) {
        e.preventDefault();
        $('#addIceCreamModal').modal('hide');
        initStep(2);
        IceCream = $('#IceCream_details').serializeJSON();
    })
    // Step 2
    $('#iceCreamModal_flavors #previous-step').click(function (e) {
        $('#iceCreamModal_flavors').modal('hide');
        initStep(1);
    })
    $('#iceCream_flavors').submit(function (e) {
        e.preventDefault()
        var msgError = $('#iceCreamModal_flavors #msgError');
        let flavorList = $('#iceCream_flavorsList').find(':checked');
        if ($('#iceCream_flavors #iceCream_any_flavors').is(':checked')) {
            if (flavorList.length > 0) {
                msgError.css('display', 'block');
                msgError.html('No se pueden usar ambas opciones a la vez.');
            } else {
                msgError.css('display', 'none');
                $('#iceCreamModal_flavors').modal('hide');
                IceCream['flavor'] = 'any';
                initStep(3);
                console.log(IceCream);
            }
        } else {
            if (flavorList.length > 0) {
                msgError.css('display', 'none');
                $('#iceCreamModal_flavors').modal('hide');
                initStep(3);
                let flavor = "";
                for (let item of flavorList) {
                    flavor += (item['value']) + ',';
                }
                IceCream['flavor'] = flavor.substring(0, flavor.length - 1);
            } else {
                msgError.css('display', 'block');
                msgError.html('Debes seleccionar al menos un sabor.');
            }
        }
    })
    // Step 3
    $('#iceCreamModal_filling #previous-step').click(function (e) {
        $('#iceCreamModal_filling').modal('hide');
        initStep(2);
    })
    $('#iceCream_filling').submit(function (e) {
        e.preventDefault();
        var msgError = $('#iceCreamModal_filling #msgError');
        var fillingList = $('#iceCream_fillingList').find(':checked');
        if ($('#iceCream_filling #iceCream_any_filling').is(':checked')) {
            if (fillingList.length > 0) {
                msgError.css('display', 'block');
                msgError.html('No se pueden usar ambas opciones a la vez.');
            } else {
                msgError.css('display', 'none');
                $('#iceCreamModal_filling').modal('hide');
                initStep(4);
                IceCream['filling'] = 'any';
            }
        } else {
            if ($('#iceCream_fillingList').find(':checked').length > 0) {
                msgError.css('display', 'none');
                $('#iceCreamModal_filling').modal('hide');
                initStep(4);
                let filling = "";
                for (let item of fillingList) {
                    filling += (item['value']) + ',';
                }
                IceCream['filling'] = filling.substring(0, filling.length - 1);
            } else {
                msgError.css('display', 'block');
                msgError.html('Debes seleccionar al menos un sabor.');
            }
        }
    })
    // Step 4
    $('#iceCreamModal_topping #previous-step').click(function (e) {
        $('#iceCreamModal_topping').modal('hide');
        initStep(3);
    })
    $('#iceCream_topping').submit(function (e) {
        e.preventDefault();
        var msgError = $('#iceCreamModal_topping #msgError');
        var toppingList = $('#iceCream_toppingList').find(':checked');
        if ($('#iceCream_topping #iceCream_any_topping').is(':checked')) {
            if (toppingList.length > 0) {
                msgError.css('display', 'block');
                msgError.html('No se pueden usar ambas opciones a la vez.');
            } else {
                msgError.css('display', 'none');
                $('#iceCreamModal_topping').modal('hide');
                initStep(5)
                IceCream['topping'] = 'any';
            }
        } else {
            if ($('#iceCream_toppingList').find(':checked').length > 0) {
                msgError.css('display', 'none');
                $('#iceCreamModal_topping').modal('hide');
                initStep(5)
                let topping = "";
                for (let item of toppingList) {
                    topping += (item['value']) + ',';
                }
                IceCream['topping'] = topping.substring(0, topping.length - 1);
            } else {
                msgError.css('display', 'block');
                msgError.html('Debes seleccionar al menos un topping.');
            }
        }
    })

    // Step 5
    function resetIceCream() {
        IceCream = undefined;
        processCurrentStep = undefined;
        $('#iceCream_flavors').trigger('reset');
        $('#iceCream_filling').trigger('reset');
        $('#iceCream_topping').trigger('reset');
        $('#iceCream_container').trigger('reset');
    }

    function saveIceCream() {
        const msgError = $('#iceCreamModal_container #msgError');
        const msgLoad = $('#iceCreamModal_container #msgLoad');
        if (IceCream['name'] !== undefined && IceCream['flavor'] !== undefined && IceCream['filling'] !== undefined && IceCream['topping'] !== undefined && IceCream['container'] !== undefined) {
            const msgSuccess = $('#iceCreamModal_container #msgSuccess');
            $.post("/enrrolato/action/add/icecream", IceCream, function (text) {
                let trash = text.split("||$$||")
                let response = JSON.parse(trash[1]);
                if (response['success']) {
                    msgLoad.css('display', 'none');
                    msgSuccess.css('display', 'block');
                    msgSuccess.html(response['posted']);
                    resetIceCream();
                } else {
                    msgLoad.css('display', 'none');
                    msgError.css('display', 'block');
                    msgError.html(response['error']);
                }
            }, "text").done(function () {
                updateIngredients('icecream');
            }).fail(function () {
                alert("error");
            }).always(function () {
                console.log(IceCream);
            });
        } else {
            msgError.css('display', 'block');
            msgError.html('Faltan datos del helado, no se puede agregar.');
        }
    }

    $('#iceCreamModal_container #previous-step').click(function (e) {
        $('#iceCreamModal_container').modal('hide');
        initStep(4);
    })
    $('#iceCream_container').submit(function (e) {
        e.preventDefault();
        const msgError = $('#iceCreamModal_container #msgError');
        const msgLoad = $('#iceCreamModal_container #msgLoad');
        const containerList = $('#iceCream_containerList').find(':checked');
        msgError.css('display', 'block');
        if ($('#iceCream_container #iceCream_any_container').is(':checked')) {
            if (containerList.length > 0) {
                msgError.css('display', 'block');
                msgError.html('No se pueden usar ambas opciones a la vez.');
            } else {
                msgLoad.css('display', 'block');
                msgError.css('display', 'none');
                IceCream['container'] = 'any';
                saveIceCream();
            }
        } else {
            if ($('#iceCream_containerList').find(':checked').length > 0) {
                msgError.css('display', 'none');
                let container = "";
                for (let item of containerList) {
                    container += (item['value']) + ',';
                }
                IceCream['container'] = container.substring(0, container.length - 1);
                saveIceCream();
            } else {
                msgError.css('display', 'block');
                msgError.html('Debes seleccionar al menos un envase.');
            }
        }
    });

    function updatePrices() {
        const msgError = $('#prices #msgError');
        const msgLoad = $('#prices #msgLoad');
        const msgSuccess = $('#prices #msgSuccess');
        var data = undefined;
        $.post("/enrrolato/action/get/json/prices", {}, function (text) {
            let trash = text.split("||$$||")
            let response = JSON.parse(trash[1]);
            if (response['success']) {
                data = JSON.parse(response['json']);
                msgLoad.css('display', 'none');
                msgSuccess.css('display', 'block');
                msgSuccess.html('Se ha cargado los precios correctamente.');
            } else {
                msgLoad.css('display', 'none');
                msgError.css('display', 'block');
                msgError.html(response['error']);
            }
        }, "text").done(function () {
            if (data !== undefined) {
               $('#regularPrice').val(data['regular_price']);
               $('#regularFlavorAmount').val(data['flavor_amount']);
               $('#regularFillingAmount').val(data['filling_amount']);
               $('#regularToppingAmount').val(data['topping_amount']);
               $('#regularExtraToppingPrice').val(data['extra_topping_price']);
               $('#specialFlavorPrice').val(data['special_flavor']);
               $('#liqueurFlavorPrice').val(data['liqueur_flavor']);
               $('#seasonIceCreamPrice').val(data['season_ice_cream']);
            }
        }).fail(function () {
            alert("error");
        }).always(function () {

        });
    }

    $(document).ready(function () {
            updatePrices();
        }
    );

    $('#prices-form').submit(function (e) {
        e.preventDefault();
        const changePricesForm = $('#prices-form');
        const changePricesButton = $('#change-prices');
        const msgError = $('#prices #msgError');
        const msgLoad = $('#prices #msgLoad');
        const msgSuccess = $('#prices #msgSuccess');

        if (changePricesButton.val() === '0') {
            changePricesForm.find('input').prop("readonly", false);
            changePricesButton.html('Guardar');
            changePricesButton.val('1');
        } else {
            changePricesForm.find('input').prop("readonly", true);
            msgError.css('display', 'none');
            msgLoad.css('display', 'block');
            msgSuccess.css('display', 'none');
            $.post("/enrrolato/action/edit/prices", changePricesForm.serializeJSON(), function (text) {
                let trash = text.split("||$$||")
                let response = JSON.parse(trash[1]);
                if (response['success']) {
                    msgLoad.css('display', 'none');
                    msgSuccess.css('display', 'block');
                    msgSuccess.html(response['posted']);
                } else {
                    msgLoad.css('display', 'none');
                    msgError.css('display', 'block');
                    msgError.html(response['error']);
                }
            }, "text").done(function () {
            }).fail(function () {
                alert("error");
            }).always(function () {

            });
            changePricesButton.html('Modificar');
            changePricesButton.val('0');
        }
    });
});