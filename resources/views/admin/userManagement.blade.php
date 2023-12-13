@extends('layouts.admin')

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <p class="fs-1 fw-bold">User Management</p>
    <p class="fs-4">Date: {{now()->toDateString()}}</p>
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Add Product
    </button> --}}
    <div class="p-4 mx-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Date Created</th>
                <th scope="col">role</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $user)
              <tr>
                <th scope="row">{{$user["id"]}}</th>
                <td>{{$user['name']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['password']}}</td>
                <td>{{$user['created_at']}}</td>
                <td>{{$user['role']}}</td>
                <td style="display:flex;flex-direction:row;">
                    <a href="#" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                    <form action="{{ route('admin.changeRole', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary mx-2">
                            @if($user['role']==1)
                                Admin
                            @else
                                User
                            @endif
                            {{-- <i class="fas fa-ellipsis-v"></i> --}}
                        </button>
                    </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
    </div>

@endsection
