@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">Add Admin User</a>
            @if ($admin->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">Admin Users</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr>
                                        <td scope="row">{{ $a->nama }}</td>
                                        <td>{{ $a->username }}</td>
                                        <td>{{ $a->telp }}</td>
                                        <td>
                                            @if($a->status == 1)
                                                <span class="badge badge-success text-uppercase">Active</span>
                                            @else
                                                <span class="badge badge-danger text-uppercase">Not Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.petugas.edit', $a->id) }}" class="btn btn-primary btn-sm float-left">Edit</a>

                                            <form action="{{ route('admin.petugas.destroy', $a->id) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm ml-1">Delete</button>
                                            </form>
                                            
                                            @if($a->status == 0)
                                                <form action="{{ route('admin.petugas.status.update', $a->id) }}" method="POST" class="float-left">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-success btn-sm ml-1">Actived</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.petugas.status.update', $a->id) }}" method="POST" class="float-left">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button type="submit" class="btn btn-success btn-sm ml-1">Deactive</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-header">Admin Users</div>
                    <div class="card-body">
                        Tidak ada Admin Users
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
