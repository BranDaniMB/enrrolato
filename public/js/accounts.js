/**
 * Refresh page content when an account is deleted or added
 */
function updateAccounts() {
    $.post("/enrrolato/action/get/list/account", {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            $('#authAccounts').html(response['html']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
    $.post("/enrrolato/action/get/list/temp_account", {}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            $('#tempAccounts').html(response['html']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

/**
 * Page: ModifyAccount.php
 * Change the modal and AJAX to delete.
 * @param type
 * @param account
 */
function deleteModal(type, account) {
    const deleteModal = $('#deleteConfirmModal');
    const deleteSubmit = $("#deleteConfirmModal #delete-submit");
    const msgLoad = $('#deleteConfirmModal #msgLoad');
    const msgError = $('#deleteConfirmModal #msgError');
    const msgSuccess = $('#deleteConfirmModal #msgSuccess');

    deleteModal.find('.modal-title').text(("Eliminar {account}").replace("{account}", account));
    deleteModal.modal('show');
    deleteSubmit.off('click');
    deleteSubmit.click(function () {
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        $.post("/enrrolato/action/delete/" + type, {email: account}, function (text) {
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
            updateAccounts();
        }).fail(function () {
            alert("error");
        }).always(function () {
        });
    });
}

$(document).ready(function () {
    /**
     * Submit
     * Add account
     */
    $('#addAccount').submit(function (e) {
        e.preventDefault();
        const msgLoad = $('#addAccountModal #msgLoad');
        const msgError = $('#addAccountModal #msgError');
        const msgSuccess = $('#addAccountModal #msgSuccess');
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        msgLoad.css('display', 'block');
        const form = $('#addAccount');
        $.post("/enrrolato/action/add/account", form.serializeJSON(), function (text) {
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
            updateAccounts();
        }).fail(function () {
            alert("error");
        }).always(function () {

        });
    });
});