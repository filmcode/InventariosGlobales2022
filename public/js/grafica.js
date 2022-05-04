'use strict';
// DOM
const _token = document.querySelector('[name=_token]').value;
// ajax

const ajaxGrafica = statusGrafica => {
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                resolve(this.responseText);
            }
        }
        xhttp.open("POST", "/ajaxGrafica");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`_token=${_token}&status=${statusGrafica}`);
    });
}

const filterSearchAjax = (statusFilter, dateDe, dateA) => {
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(JSON.parse(this.responseText));
                resolve(JSON.parse(this.responseText));
            }
        }
        xhttp.open("POST", "/ajaxGrafica");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`_token=${_token}&status=${statusFilter}&dateDe=${dateDe}&dateA=${dateA}`);
    });
}
window.addEventListener('load', async() => {
    const ctx = document.getElementById('myChart');
    const dataChart = await ajaxGrafica(statusGrafica.value);
    console.log(dataChart);
    graficaChart(ctx, dataChart);
})

const graficaChart = (ctx, ajaxData) => {
    const dataChart = JSON.parse(ajaxData);
    console.log(dataChart);
    // chart
    let chartStatus = Chart.getChart("myChart");
    if (chartStatus != undefined) {
        chartStatus.destroy();
    }
    const myChart = new Chart(ctx.getContext('2d'), {
        type: 'bar',
        data: {
            labels: dataChart['labels'],
            datasets: [{
                maxBarThickness: 80,
                label: '',
                data: dataChart['datos'],
                backgroundColor: dataChart['bg'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}

statusGrafica.addEventListener('change', async() => {
    const dataChart = await ajaxGrafica(statusGrafica.value);
    if (statusGrafica.value == "intercambio") {
        result.innerHTML = dataChart;
        filterSearch.addEventListener('click', async(e) => {
            e.preventDefault();
            const dataAjax = await filterSearchAjax('filterSearch', dateDe.value, dateA.value);
            if (typeof resultFilter != 'undefined') {
                resultFilter.innerHTML = '';
            }
            if (dataAjax.length > 0) {
                // show data
                dataAjax.forEach(data => {
                    const tr = document.createElement('tr');

                    const idTable = document.createElement('td');
                    idTable.append(data['id']);

                    const lineaTable = document.createElement('td');
                    lineaTable.append(data['linea']);

                    const intercambioTable = document.createElement('td');
                    intercambioTable.append(data['intercambio']);

                    const fechaTable = document.createElement('td');
                    fechaTable.append(data['created_at']);
                    // añadir td al tr
                    tr.append(idTable);
                    tr.append(lineaTable);
                    tr.append(intercambioTable);
                    tr.append(fechaTable);
                    resultFilter.append(tr);
                });
            } else {
                const tr = document.createElement('tr');

                const td = document.createElement('td');
                td.append('No se encontro ningun registro');
                td.setAttribute('class', 'text-center')
                td.setAttribute('colspan', '4')
                    // añadir td al tr
                tr.append(td);
                resultFilter.append(tr);
            }
        })
    } else {
        result.innerHTML = 'Cargando...'
        const ctx = document.createElement('canvas')
        ctx.setAttribute('class', 'mychart')
        result.innerHTML = '';
        result.append(ctx)
        graficaChart(ctx, dataChart);
    }
});