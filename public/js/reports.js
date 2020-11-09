const { jsPDF } = window.jspdf;

// Chart Config
Chart.defaults.global.defaultFontColor = 'black';
Chart.defaults.global.defaultFontFamily = 'Gotu';
Chart.defaults.global.elements.line.fill = false;
Chart.defaults.global.elements.line.borderColor = 'rgba(0, 0, 0, 0.3)';

var EarningsChart;
var QuantityOrdersChart;

function generateEarningsChart() {
    const i_earnings_startTime = $('#earnings_startTime');
    const i_earnings_endTime = $('#earnings_endTime');
    $.post("/enrrolato/action/get/json/earnings", {earnings_startTime: i_earnings_startTime.val(), earnings_endTime: i_earnings_endTime.val()}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            try {
                EarningsChart.destroy();
            } catch (error) {
            }
            const chartData = JSON.parse(response['json']);
            let ctx = $('#earnings-report');
            let chartType = $('#earnings-chart-type');
            EarningsChart = new Chart(ctx, {
                type: chartType.val(),
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Ganancias por día',
                        data: chartData.data,
                        backgroundColor: chartData.backgroundColor
                    }]
                }
            });
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function generateQuantityOrdersChart() {
    const i_quantityOrders_startTime = $('#quantityOrders_startTime');
    const i_quantityOrders_endTime = $('#quantityOrders_endTime');
    $.post("/enrrolato/action/get/json/quantity_orders", {quantityOrders_startTime: i_quantityOrders_startTime.val(), quantityOrders_endTime: i_quantityOrders_endTime.val()}, function (text) {
        let trash = text.split("||$$||")
        let response = JSON.parse(trash[1]);
        if (response['success']) {
            try {
                QuantityOrdersChart.destroy();
            } catch (error) {
            }
            const chartData = JSON.parse(response['json']);
            let ctx = $('#quantityOrders-report');
            let chartType = $('#quantityOrders-chart-type');
            QuantityOrdersChart = new Chart(ctx, {
                type: chartType.val(),
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Pedidos por día',
                        data: chartData.data,
                        backgroundColor: chartData.backgroundColor
                    }]
                }

            });
        } else {
            alert(response['error']);
        }
    }, "text").done(function () {
    }).fail(function () {
        alert("error");
    }).always(function () {
    });
}

function getCurrentDate() {
    const date = new Date();
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = date.getFullYear();
    return yyyy + '-' + mm + '-' + dd;
}

function getCurrentWeek() {
    const date = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000);
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = date.getFullYear();
    return yyyy + '-' + mm + '-' + dd;
}

function addWhiteBackground(canvas) {
    let ctx = canvas.getContext("2d");
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = "white";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}

function printEarningsChart() {
    let link = document.createElement('a');
    link.download = 'Ganancias - ' + $('#quantityOrders_startTime').val() + ' al ' + $('#quantityOrders_endTime').val() + '.png';
    let canvas = document.getElementById('earnings-report');
    addWhiteBackground(canvas);
    link.href = canvas.toDataURL();
    link.click();
}

function printQuantityOrdersChart() {
    let link = document.createElement('a');
    link.download = 'Cantidad de órdenes - ' + $('#quantityOrders_startTime').val() + ' al ' + $('#quantityOrders_endTime').val() + '.png';
    let canvas = document.getElementById('quantityOrders-report');
    addWhiteBackground(canvas);
    link.href = canvas.toDataURL();
    link.click();
}

$(document).ready(function () {
    $('#audit_startTime').val(getCurrentWeek());
    $('#audit_endTime').val(getCurrentDate());
    $('#earnings_startTime').val(getCurrentWeek());
    $('#earnings_endTime').val(getCurrentDate());
    $('#quantityOrders_startTime').val(getCurrentWeek());
    $('#quantityOrders_endTime').val(getCurrentDate());
    generateEarningsChart();
    generateQuantityOrdersChart();
});