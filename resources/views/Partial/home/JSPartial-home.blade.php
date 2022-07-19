@section('script')
    <script>
        'use strict';

        const chartOrderStatistics1 = document.querySelector('#orderStatisticsChart1'),
            orderChartConfig = {
                chart: {
                    height: 165,
                    width: 130,
                    type: 'donut'
                },
                labels: <?php echo json_encode($chartLabel); ?>,
                series: <?php echo json_encode($chartSeries); ?>,
                // series: <?php echo $tongDonHang; ?>,
                // backgroundColor: [rgb(255, 99, 132), rgb(54, 162, 235), rgb(255, 205, 86), rgb(211, 220, 227)],
                colors: ['rgb(105, 108, 255)', 'rgb(133, 146, 163)', 'rgb(3, 195, 236)', 'rgb(113, 221, 55)'],
                stroke: {
                    width: 5,
                    colors: 'rgb(255, 255, 255)'
                },
                dataLabels: {
                    enabled: false,
                    formatter: function(val, opt) {
                        return parseInt(val) + '%';
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        right: 15
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '1.5rem',
                                    fontFamily: 'Public Sans',
                                    color: 'rgb(0, 0, 0)',
                                    offsetY: -15,
                                    formatter: function(val) {
                                        return parseInt(val) + '%';
                                    }
                                },
                                name: {
                                    offsetY: 20,
                                    fontFamily: 'Public Sans'
                                },
                                total: {
                                    show: true,
                                    fontSize: '0.8125rem',
                                    color: 'rgb(29, 233, 182)',
                                    label: 'Ngày',
                                    formatter: function(w) {
                                        return '100%';
                                    }
                                }
                            }
                        }
                    }
                }
            };
        if (typeof chartOrderStatistics1 !== undefined && chartOrderStatistics1 !== null) {
            const statisticsChart = new ApexCharts(chartOrderStatistics1, orderChartConfig);
            statisticsChart.render();
        }

        function refreshDiv() {
            $("#refresh-statis").load(window.location.href + " #refresh-statis");
        }
    </script>
@endsection
