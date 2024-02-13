@extends('future::layouts.app')

@section('content')
    <div class="card" style="height: 100vh">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-8 col-sm-12">
                    <div id="chart"></div>
                </div>
                <div class="col-12 col-md-4 col-sm-12">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://unpkg.com/dayjs/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        var options = {
            series: [{
                name: 'candle',
                data: [
                    {
                        x: new Date(1538778600000),
                        y: [0.81, 0.5, 0.04, 4.33]
                    },
                ]
            }],
            chart: {
                height: 350,
                type: 'candlestick',
            },
            title: {
                text: 'CandleStick Chart - Category X-axis',
                align: 'left'
            },
            annotations: {
                xaxis: [
                    {
                        x: 'Oct 06 14:00',
                        borderColor: '#00E396',
                        label: {
                            borderColor: '#00E396',
                            style: {
                                fontSize: '12px',
                                color: '#fff',
                                background: '#00E396'
                            },
                            orientation: 'horizontal',
                            offsetY: 7,
                            text: 'Annotation Test'
                        }
                    }
                ]
            },
            tooltip: {
                enabled: true,
            },
            xaxis: {
                type: 'category',
                labels: {
                    show: false,

                }
            },
            yaxis: {
                tooltip: {
                    enabled: true
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        // Hàm thêm dữ liệu ngẫu nhiên
        function addRandomData() {
            var lastDataPoint = options.series[0].data[options.series[0].data.length - 1];
            var lastDate = lastDataPoint.x;

            var newDate = new Date(lastDate.getTime() + 1000); // Thêm 1 giây vào ngày cuối cùng

            var yValues = [];
            for (var i = 0; i < 4; i++) {
                yValues.push(Math.random() * 1000);
            }

            var newDataPoint = {
                x: newDate,
                y: yValues
            };

            options.series[0].data.push(newDataPoint);

            // Loại bỏ điểm dữ liệu đầu tiên để tránh biểu đồ quá tải
            if (options.series[0].data.length > 100) {
                options.series[0].data.shift();
            }

            chart.updateOptions({
                series: options.series
            });
        }

        // Cập nhật biểu đồ mỗi giây
        setInterval(addRandomData, 1000);
    </script>
@endsection
