@extends('layouts.user')

@section('content')
<div>
    {{-- <p class="fs-1 fw-bold">Product List</p> --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <p class="fs-1 fw-bold">Crop Sales Tracker</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        Add Record
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Crop</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity(kg)</th>
                <th scope="col">Date Created</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $crop)
                <tr>
                    <td>{{$crop['name']}}</td>
                    <td>{{$crop['price']}}</td>
                    <td>{{$crop['quantity']}}</td>
                    <td>{{$crop['created_at']}}</td>
                    <td style="display: flex; flex-direction:row;">
                        <form action="{{ route('product.destroy', $crop->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-2">
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
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addProductForm" action="{{ route('product.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Crop Sale Record</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                            <div class="form-group">
                                <label for="crop">Crop</label>
                                <select required class="form-control" id='crop_id'name="crop_id">
                                    <option value="">Please select a crop</option>
                                    @foreach($options as $cropId => $cropName)
                                        <option value="{{$cropId}}">{{$cropName}}</option>
                                    @endforeach

                                </select>
                                <span class="invalid-feedback"></span>
                            </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input required type="number" name="price" id="price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity(kg)</label>
                                    <input required type="number" name="quantity" id="quantity" class="form-control">
                                </div>

                            </form>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
