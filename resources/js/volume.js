// resources/js/volume.js
const optionsVolume = {
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: true,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: 0
        },
    },
    series: [
        {
            name: "Pengguna Baru",
            data: [6500, 6418, 6456, 6526, 6000, 6456],
            color: "#1A56DB",
        },
    ],
    xaxis: {
        categories: ['01 Februari', '02 Februari', '03 Februari', '04 Februari', '05 Februari', '06 Februari', '07 Februari'],
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
    },
}

if (document.getElementById("area-chart-volume") && typeof ApexCharts !== 'undefined') {
    const chartVolume = new ApexCharts(document.getElementById("area-chart-volume"), optionsVolume);
    chartVolume.render();
} else {
    console.error("Tidak dapat menemukan elemen dengan id 'area-chart-volume' atau ApexCharts tidak terdefinisi.");
}

if (document.getElementById("area-chart-volume-2") && typeof ApexCharts !== 'undefined') {
    const chartVolume2 = new ApexCharts(document.getElementById("area-chart-volume-2"), optionsVolume);
    chartVolume2.render();
} else {
    console.error("Tidak dapat menemukan elemen dengan id 'area-chart-volume-2' atau ApexCharts tidak terdefinisi.");
}
