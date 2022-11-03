import ApexCharts from 'apexcharts';

let ajaxSeries;
$('document').ready(function () {
    $.ajax({
        type: 'GET',
        url: rootUrl + '/ajax/getBovinosByGender',
        success: function (response) {
            response = JSON.parse(response)

            var options = {
                series: [response[0]['total'], response[1]['total']],
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

            let chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    })
})




