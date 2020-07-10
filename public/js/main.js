function setAddAction(type) {
    const addButton = $('#add-ingredient-button');
    addButton.attr("data-target", "#add" + type + "Modal");
    switch (type) {
        case 'IceCream':
            addButton.html("Agregar un helado");
            break;
        case 'Flavor':
            addButton.html("Agregar un sabor");
            break;
        case 'Filling':
            addButton.html("Agregar un jarabe");
            break;
        case 'Topping':
            addButton.html("Agregar un topping");
            break;
        case 'Container':
            addButton.html("Agregar un envase");
            break;
    }
}

function modifyFlavor(flavor) {
    alert(flavor);
}

function deleteModal(type, name) {
    const deleteModal = $('#deleteConfirmModal');
    const deleteSubmit = $("#deleteConfirmModal #delete-submit");
    const msgLoad = $('#deleteConfirmModal #msgLoad');
    const msgError = $('#deleteConfirmModal #msgError');
    const msgSuccess = $('#deleteConfirmModal #msgSuccess');
    deleteModal.on('show.bs.modal', function (event) {
        deleteModal.find('.modal-title').text(("Eliminar {ingredient}").replace("{ingredient}", name));
        msgLoad.css('display', 'none');
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
    })
    deleteModal.on('hidden.bs.modal', function (event) {
        deleteSubmit.off("click");
    })
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

function updateIngredients(type) {
    $.post("/enrrolato/action/get/" + type, {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        switch (type) {
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
}

$(document).ready(function () {
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

    $('#addFlavorModal').on('show.bs.modal', function (event) {
        $('#addFlavorModal #msgLoad').css('display', 'none');
        $('#addFlavorModal #msgError').css('display', 'none');
        $('#addFlavorModal #msgSuccess').css('display', 'none');
    });

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

    $('#addFillingModal').on('show.bs.modal', function (event) {
        $('#addFillingModal #msgLoad').css('display', 'none');
        $('#addFillingModal #msgError').css('display', 'none');
        $('#addFillingModal #msgSuccess').css('display', 'none');
    });

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

    $('#addToppingModal').on('show.bs.modal', function (event) {
        $('#addToppingModal #msgLoad').css('display', 'none');
        $('#addToppingModal #msgError').css('display', 'none');
        $('#addToppingModal #msgSuccess').css('display', 'none');
    });

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
    $('#addContainerModal').on('show.bs.modal', function (event) {
        $('#addContainerModal #msgLoad').css('display', 'none');
        $('#addContainerModal #msgError').css('display', 'none');
        $('#addContainerModal #msgSuccess').css('display', 'none');
    });

    // IceCream Create Process
    var processCurrentStep;
    var IceCream;

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
    $('#addIceCreamModal').on('show.bs.modal', function (e) {
        if (processCurrentStep === undefined) {
            initStep(1);
        } else {
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
    })
});