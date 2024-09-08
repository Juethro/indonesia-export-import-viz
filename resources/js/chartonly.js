var options = {
    chart: {
        type: 'line',
        height: 350
    },
    series: [{
        name: '',
        data: []
    }],
    xaxis: {
        categories: []
    },
    title: {
        text: ' Trend Over Month ',
        align: 'center'
    }
};

var chart = new ApexCharts(document.getElementById("chart"), options);

chart.render();


document.addEventListener('DOMContentLoaded', function() {
    postData();
});



window.postData = function() {
    // console.log(optionsNilai);
    console.log({
        tahun: document.getElementById("tahun").value,
        tipe: document.getElementById("tipe").value,
        jenis: document.getElementById("jenis").value,
        volorval: document.getElementById("volorval").value,
    });
    fetch('/data/chart_5', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            tahun: document.getElementById("tahun").value,
            tipe: document.getElementById("tipe").value,
            jenis: document.getElementById("jenis").value,
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
        console.log(data);
    })
    .catch(error => console.error("Error:", error));
}