@extends('layouts.user')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="m-3"><a href="{{route("salesStatistics")}}" class="btn btn-secondary-outline">Back</a></div>
        <h1 class="text-center">Crop Sales Chart</h1>
    <div id="chart-container">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // function goBack() {
        //     window.history.back();
        // }
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: {!! $dates !!},
                datasets: [{
                    label: "Sales",
                    data: {!! $sales !!},
                    backgroundColor: "rgba(255, 99, 132, 0.5)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
