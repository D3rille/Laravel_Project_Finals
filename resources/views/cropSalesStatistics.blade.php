@extends('layouts.user')

@section('content')
    {{ setlocale(LC_MONETARY, 'en_PH') }}
    <div class="container mt-4">
        <style>
            /* Add these styles to your CSS file */
            .container {
                max-width: 800px;
                /* Adjust as needed */
            }

            .table th,
            .table td {
                text-align: center;
            }

            .btn-success {
                background-color: #2E603A;
                border-color: #2E603A;
            }

            .btn-success:hover {
                background-color: #286652;
                border-color: #286652;
                color: #fff;
            }
        </style>
        <h1 class="fw-bold fs-2">Crop Sales Statistics</h1>
        <p class="fs-4">Data as of {{ now()->toDateString() }}</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Avg. Price</th>
                    <th>Sales Change (24hr)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $crop)
                    <tr>
                        <td>{{ $crop['name'] }}</td>
                        <td>P {{ number_format($crop['average_price'], 2) }}</td>
                        <td
                            style="color:
                        @if ($crop['sales_change'] > 0) green
                        @elseif($crop['sales_change'] < 0)
                            red
                        @else
                            black @endif
                    ">
                            {{ round($crop['sales_change'], 2) }} %</td>
                        <td>
                            <a href="{{ route('graph', ['cropName' => $crop['name'], 'id' => $crop['crop_id']]) }}"
                                class="btn btn-success">Graph</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
