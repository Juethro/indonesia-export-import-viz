var options = {
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
var chart = new ApexCharts(document.getElementById("chart"), options);
chart.render();

// Ganti Chart ke BarChart ataupun Sebaliknya
document.getElementById('chart_type').addEventListener('change', function() {
    if (this.value === '0') {
        options.chart.type = 'line';
        options.stroke.show = true;
    } else if (this.value === '1') {
        options.chart.type = 'bar';
        options.stroke.show = false;
    }
    chart.updateOptions(options);
});


// Jalankan fungsi ketika halaman barusaja diload
document.addEventListener('DOMContentLoaded', function() {
    postData();
});

// Fungsi Ambil Data Dari Rute Laravel
window.postData = function() {
    // console.log({
    //     tahun: document.getElementById("tahun").value,
    //     tipe: document.getElementById("tipe").value,
    //     volorval: document.getElementById("volorval").value,
    // });
    fetch('/data/chart_5', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            tahun: document.getElementById("tahun").value,
            tipe: document.getElementById("tipe").value,
            volorval: document.getElementById("volorval").value,
        }),
    })
    .then(response => response.json())
    .then(data => {
        options.series[0].name = document.getElementById('volorval').value;
        options.series[0].data = data.dataAngka;
        options.xaxis.categories = data.bulan;
        options.title.text = document.getElementById('volorval').value + " Trend Over Month In " + document.getElementById('tahun').value;
        chart.updateOptions(options);
    })
    .catch(error => console.error("Error:", error));
}