@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <style>
            /* Add these styles to your CSS file */
            .product-list-card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                background-color: #F6F6F6;
            }

            .table th,
            .table td {
                text-align: center;
            }

            
            .btn-primary {
                background-color: #2E603A;
                border-color: #2E603A;
            }

            .btn-primary:hover {
                background-color: #286652;
                border-color: #286652;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card product-list-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-3 fw-bold">Product List</span>
                            <span class="fs-5">Data as of {{ now()->toDateString() }}</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Add Product
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">CropId</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Average Price</th>
                                        <th scope="col">Sales Change</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $crop)
                                        <tr>
                                            <th scope="row">{{ $crop['crop_id'] }}</th>
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
                                                {{ round($crop['sales_change'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('crops.destroy', $crop['crop_id']) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('crops.store') }}" method="post">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Crop</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input field inside the modal body -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Crop Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Crop Name"
                                name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
