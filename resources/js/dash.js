import ApexCharts from 'apexcharts';


var options = {
    series: [44, 23],
    labels: ['Bois Fêmeas', 'Bois Machos'],
    chart: {
        type: 'donut',
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();