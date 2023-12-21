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
            .user-management-card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                background-color: #F6F6F6;
            }

            .table th,
            .table td {
                text-align: center;
            }



            .btn-danger:hover,
            .btn-outline-secondary:hover {
                background-color: #286652;
                border-color: #286652;
                color: #fff;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card user-management-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-4 fw-bold">User Management</span>
                            <span class="fs-5">Date: {{ now()->toDateString() }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $user)
                                        <tr>
                                            <th scope="row">{{ $user['id'] }}</th>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['created_at'] }}</td>
                                            <td>
                                                @if ($user['role'] == 1)
                                                    Admin
                                                @else
                                                    User
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger mx-2" type="submit">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.changeRole', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success text-white btn-outline-secondary mx-2">
                                                            @if ($user['role'] == 1)
                                                                Set as User
                                                            @else
                                                                Set as Admin
                                                            @endif
                                                        </button>
                                                    </form>
                                                </div>
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
@endsection
