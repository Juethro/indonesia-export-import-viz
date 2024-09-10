// Selamat Mengerjakan!!
var options_chart_2 = {
    chart: {
        type: 'line',
        height: 350
    },
    fill: {
        colors: ['#FA5C49', '#4F9C8C']
    },
    stroke: {
        show: true
    },
    series: [
        {
            name: 'Oil & Gas',
            data: []
        },
        {
            name: 'Non Oil & Gas',
            data: []
        }
    ],
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: []
    },
    title: {
        text: 'Comparison of Oil & Gas vs Non Oil & Gas',
        align: 'left'
    }
};

var chart_2 = new ApexCharts(document.getElementById("chart_2"), options_chart_2);
chart_2.render();

document.addEventListener('DOMContentLoaded', function() {
    postData_2();
});

window.postData_2 = function() {

    // buat debug, kalau udah ga kepake dikomen aja
    console.log({
        tahun_2: document.getElementById("tahun_2").value,
        tipe_2: document.getElementById("tipe_2").value,
        volorval_2: document.getElementById("volorval_2").value,
    });

    fetch('/data/chart_7', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            tahun_2: document.getElementById("tahun_2").value,
            tipe_2: document.getElementById("tipe_2").value,
            volorval_2: document.getElementById("volorval_2").value
        }),
    })
        .then(response => response.json())
        .then(data => {
            options_chart_2.series[0].data = data.dataAngkaOilGas;
            options_chart_2.series[1].data = data.dataAngkaNonOilGas;
            options_chart_2.xaxis.categories = data.bulan;

            chart_2.updateOptions(options_chart_2);
            console.log(data); // Matikan Jika Sudah selesai Debug

        })
        .catch(error => console.error("Error:", error));
}
