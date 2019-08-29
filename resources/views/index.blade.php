<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>График предмета</title>
</head>
<body>
<div id="chart"></div>
<div class="container">
    <h1>List of items:</h1>
    <hr>
    <div id="list">
        @foreach ($items as $item)
            <a target="_blank"
               href="https://steamcommunity.com/market/listings/{{ $item->game_id }}/{{ $item->hash_name }}"><img
                    src="/images/steam.png" width="20px" alt="Steam icon"></a>
            <a href="{{ route('index', $item->id) }}">{{ $item->name }}</a>
            <br>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="/js/highstock.js"></script>
<script src="/js/exporting.js"></script>
<script src="/js/export-data.js"></script>
<script>
    Highcharts.stockChart('chart', {
        rangeSelector: {
            buttons: [{
                type: 'day',
                count: 7,
                text: '1W'
            }, {
                type: 'month',
                count: 1,
                text: '1M'
            }, {
                type: 'all',
                count: 1,
                text: 'All'
            }],
            selected: 2,
            inputEnabled: false
        },

        title: {
            text: "{{ $itemName }}"
        },

        series: [{
            name: 'Количество',
            data: {{ $jsonData }},
            marker: {
                enabled: true,
                radius: 3
            },
            shadow: true,
            tooltip: {
                valueDecimals: 0
            }
        }]
    });
</script>
</body>
</html>
