var options_chart_1 = {
    chart: {
        type: 'line',
        height: 350
    },
    fill: {
        colors: ['#FA5C49']
    },
    stroke: {
        show: true
    },
    // Data
    series: [{
        name: '',
        data: []
    }],
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: []
    },
    title: {
        text: '',
        align: 'left'
    }
};

// Render Pertama Options (tanpa data)
var chart = new ApexCharts(document.getElementById("chart_1"), options_chart_1);
chart.render();

// Ganti Line Chart ke BarChart ataupun Sebaliknya
document.getElementById('chart_type').addEventListener('change', function() {
    if (this.value === '0') {
        options_chart_1.chart.type = 'line';
        options_chart_1.stroke.show = true;
    } else if (this.value === '1') {
        options_chart_1.chart.type = 'bar';
        options_chart_1.stroke.show = false;
    }
    chart.updateOptions(options_chart_1);
});


// Selalu run fungsi ketika halaman diload
document.addEventListener('DOMContentLoaded', function() {
    postData_1();
});

// Fungsi Ambil Data Dari Rute Laravel (POST, JSON) Pasti mengubah options_chart_1
window.postData_1 = function() {

    // buat debug, kalau udah ga kepake dikomen aja
    console.log({
        tahun: document.getElementById("tahun").value,
        tipe: document.getElementById("tipe").value,
        volorval: document.getElementById("volorval").value,
    }); 

    // Post Data
    fetch('/data/chart_5', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil X-CSRF-TOKEN dari Head element Meta Biar Ga Error 419
        },
        body: JSON.stringify({
            tahun: document.getElementById("tahun").value,
            tipe: document.getElementById("tipe").value,
            volorval: document.getElementById("volorval").value,
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Ubah data
        options_chart_1.series[0].name = document.getElementById('volorval').value;
        options_chart_1.series[0].data = data.dataAngka;
        options_chart_1.xaxis.categories = data.bulan;
        options_chart_1.title.text = document.getElementById('volorval').value + " Trend Over Month In " + document.getElementById('tahun').value;
        
        // Render Ulang Chart
        chart.updateOptions(options_chart_1);
        console.log(data); // Matikan Jika Sudah selesai Debug
    })
    .catch(error => console.error("Error:", error));
}