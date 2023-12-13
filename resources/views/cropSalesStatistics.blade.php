@extends('layouts.user')

@section('content')
{{setlocale(LC_MONETARY, 'en_PH');}}
<div>
    <p class="fs-1 fw-bold">Crop Sales Statistics</p>
    <p class="fs-4">Data as of {{now()->toDateString()}}</p>
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
            @foreach($data as $crop)
            <tr>
                <td>{{$crop['name']}}</td>
                <td>P {{number_format($crop['average_price'], 2)}}</td>
                <td style="color:
                    @if($crop['sales_change'] > 0)
                        green
                    @elseif($crop['sales_change'] < 0)
                        red
                    @else
                        black
                    @endif
                ">{{round($crop['sales_change'], 2)}}</td>
                <td>
                    <a href="{{ route('graph', ['cropName'=>$crop['name'], 'id'=>$crop['crop_id']]) }}" class="btn btn-success graph">Graph</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
