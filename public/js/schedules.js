$(document).ready(function () {
    $('#addSchedule_repeat_1').change(function () {
        const input = $(this);
        if (input.is(":checked")) {
            $('#addSchedule_repeat_daysModal').css('display', 'none');
        }
    });
    $('#addSchedule_repeat_2').change(function () {
        const input = $(this);
        if (input.is(":checked")) {
            $('#addSchedule_repeat_daysModal').css('display', 'none');
        }
    });
    $('#addSchedule_repeat_3').change(function () {
        const input = $(this);
        if (input.is(":checked")) {
            $('#addSchedule_repeat_daysModal').css('display', 'block');
        }
    });

    $('#addSchedule').submit(function (e) {
        e.preventDefault();
        const msgError = $('#addScheduleModal #msgError');
        const msgLoad = $('#addScheduleModal #msgLoad');
        const msgSuccess = $('#addScheduleModal #msgSuccess');
        const form = $('#addSchedule');
        msgSuccess.css('display', 'none');
        msgError.css('display', 'none');
        if ($('#addSchedule_repeat_3').is(':checked')) {
            if (!($('#addSchedule_repeat_monday').is(':checked')
                || $('#addSchedule_repeat_tuesday').is(':checked')
                || $('#addSchedule_repeat_wednesday').is(':checked')
                || $('#addSchedule_repeat_thursday').is(':checked')
                || $('#addSchedule_repeat_friday').is(':checked')
                || $('#addSchedule_repeat_saturday').is(':checked')
                || $('#addSchedule_repeat_sunday').is(':checked'))) {
                msgError.css('display', 'block');
                msgError.html('Debes marcar al menos un día de la semana.');
                return;
            }
        }
        msgLoad.css('display', 'block');
        $.post("/enrrolato/action/add/schedule", form.serializeJSON(), function (text) {
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
    });
});