function markOrderAsPrepared(ID) {
    $.post("/enrrolato/action/order/prepared", {ID: ID}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            updateOrders();
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function unmarkOrderAsPrepared(ID) {
    $.post("/enrrolato/action/order/revert_prepared", {ID: ID}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            updateOrders();
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function markOrderAsDelivered(ID) {
    $.post("/enrrolato/action/order/delivered", {ID: ID}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            updateOrders();
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function unmarkOrderAsDelivered(ID) {
    $.post("/enrrolato/action/order/revert_delivered", {ID: ID}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            updateOrders();
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function markOrderAsDone(ID) {
    $.post("/enrrolato/action/order/done", {ID: ID}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            updateOrders();
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function updateOrders() {
    $.post("/enrrolato/action/get/box/current_orders", {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            $('#orders-container').html(response['html']);
        } else {
            console.log(response['error'])
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

window.setInterval(updateOrders, 15000);