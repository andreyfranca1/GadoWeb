import ApexCharts from 'apexcharts';

let ajaxSeries;
$('document').ready(function () {
    $.ajax({
        type: 'GET',
        url: rootUrl + '/ajax/getBovinosByGender',
        success: function (response) {
            response = JSON.parse(response)

            var options = {
                series: [response.femeas, response.machos],
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




