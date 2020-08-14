@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{ route('admin.masyarakat.create') }}" class="btn btn-primary mb-3">Add Masyarakat User</a>
            @if ($masyarakat->count() > 0)
                <div class="card">
                    <div class="card-header">Masyarakat Users</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masyarakat as $m)
                                    <tr>
                                        <td scope="row">{{ $m->nik }}</td>
                                        <td scope="row">{{ $m->nama }}</td>
                                        <td>{{ $m->username }}</td>
                                        <td>{{ $m->telp }}</td>
                                        <td>
                                            <a href="{{ route('admin.masyarakat.edit', $m->id) }}" class="btn btn-primary btn-sm float-left">Edit</a>
                                            <form action="{{ route('admin.masyarakat.destroy', $m->id) }}" method="POST" class="float-left">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm ml-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">Masyarakat Users</div>
                    <div class="card-body">
                        Tidak ada Masyarakat Users
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
