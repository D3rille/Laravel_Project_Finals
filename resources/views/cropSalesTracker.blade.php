@extends('layouts.user')

@section('content')
    <style>
        /* Add these styles to your CSS file */
        .container {
            max-width: 800px;
            /* Adjust as needed */
        }

        .btn-primary {
            background-color: #2E603A;
            border-color: #2E603A;
        }

        .btn-primary:hover {
            background-color: #286652;
            border-color: #286652;
        }

        .form-select {
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .modal-header {
            background-color: #2E603A;
            color: #fff;
            border-bottom: 1px solid #286652;
        }

        .modal-footer {
            border-top: 1px solid #286652;
        }

        .modal-footer button {
            margin-right: 10px;
        }
    </style>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="fw-bold fs-2">Crop Sales Tracker</h1>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Add Record
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Crop</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity (kg)</th>
                    <th scope="col">Date Created</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $crop)
                    <tr>
                        <td>{{ $crop['name'] }}</td>
                        <td>{{ $crop['price'] }}</td>
                        <td>{{ $crop['quantity'] }}</td>
                        <td>{{ $crop['created_at'] }}</td>
                        <td>
                            <form action="{{ route('product.destroy', $crop->id) }}" method="post">
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addProductForm" action="{{ route('product.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Crop Sale Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="crop_id" class="form-label">Crop</label>
                            <select required class="form-select" id="crop_id" name="crop_id">
                                <option value="">Please select a crop</option>
                                @foreach ($options as $cropId => $cropName)
                                    <option value="{{ $cropId }}">{{ $cropName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input required type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label">Quantity (kg)</label>
                            <input required type="number" name="quantity" id="quantity" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
