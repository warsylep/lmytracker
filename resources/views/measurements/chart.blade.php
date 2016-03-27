@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        {{ $def['name'] . " - " . $def['unit'] }}
    </div>

    <div class="panel-body">
        <div class="col-lg-12">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="/bower/highcharts/lib/highcharts.js"></script>

<script>
$(document).ready(function () {
    chart = new Highcharts.Chart({
        chart: {
            type: 'spline',
            renderTo: 'container',
            zoomType: 'x'
        },
        title: {
            text: ''
        },
        xAxis: {
            type: 'datetime',
            title: {
                text: 'Date'
            },
            tickInterval: 30 * 24 * 3600 * 1000,
            labels: {
                rotation: 45,
                step: 1,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial,sans-serif'
                }
            },
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%b \'%y',
                year: '%Y'
            }
        },
        yAxis: {
            title: {
                text: '{{ $def['unit'] }}'
            },
            labels: {
                formatter: function () {
                    return this.value + ' {{ $def['unit'] }}';
                }
            },
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%d %b \'%y} - {point.y:.2f} {{ $def['unit'] }}'
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                },
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
            series: [{
                name: '{{ $def['name'] }}',
                data: []
            }]
    });

    $.getJSON('{{ route('chartjson', [ 'type' => $def['type'], 'user' => $id ]) }}', function(data) {
        $.each(data, function (i, data) {
            chart.series[0].addPoint([
                new Date(data[0]).getTime(),
                data[1]
            ]);
        });
    });
});
</script>
@endsection