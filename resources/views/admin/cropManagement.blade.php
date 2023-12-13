@extends('layouts.admin')


@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <p class="fs-1 fw-bold">Product List</p>
    <p class="fs-4">Data as of {{now()->toDateString()}}</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Add Product
    </button>
    <div class="p-4 mx-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">CropId</th>
                <th scope="col">Name</th>
                <th scope="col">Average Price</th>
                <th scope="col">Sales Change</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $crop)
                    <tr>
                        <th scope="row">{{ $crop['crop_id'] }}</th>
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
                            {{-- data-bs-toggle="modal" data-bs-target="#deleteModal" --}}
                            <form action="{{ route('crops.destroy', $crop['crop_id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('crops.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Crop Name</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input field inside the modal body -->
                        <p>Enter the name of the crop.</p>
                        <input type="text" class="form-control" id="name" placeholder="Crop Name" name="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <a href="#" class="btn btn-primary">Submit</a> --}}
                        {{-- {{route("#")}} place this in href to route or just use submit and change the action on the form--}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Modal --}}
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Crop</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input field inside the modal body -->
                        <p>Are you sure you want to delete this crop? This action is irreversible, proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}
@endsection
