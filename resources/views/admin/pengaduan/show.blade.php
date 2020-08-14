@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    @if(Auth::guard('petugas')->check())
                        @if(Auth::guard('petugas')->user()->level == 'Admin' && Auth::guard('petugas')->user()->status == 1)
                            <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" style="text-decoration: none;">
                                {{ $pengaduan->masyarakat->nama }} - {{ $pengaduan->tgl_pengaduan }}
                            </a>
                        @elseif(Auth::guard('petugas')->user()->level == 'Petugas' && Auth::guard('petugas')->user()->status == 1)
                            <a href="{{ route('petugas.pengaduan.show', $pengaduan->id) }}" style="text-decoration: none;">
                                {{ $pengaduan->masyarakat->nama }} - {{ $pengaduan->tgl_pengaduan }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('masyarakat.pengaduan.show', $pengaduan->id) }}" style="text-decoration: none;">
                            {{ $pengaduan->masyarakat->nama }} - {{ $pengaduan->tgl_pengaduan }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    {{ $pengaduan->isi_laporan }}
                </div>
                @if ($pengaduan->foto)
                    <img src="{{ asset($pengaduan->foto) }}" height="350" alt="Lampiran">
                @endif

                <div class="card-body">
                    @if($pengaduan->status == 'selesai')
                        <span class="badge badge-success text-uppercase">
                            {{ $pengaduan->status }}
                        </span>
                    @endif

                    @if($pengaduan->status == 'proses')
                        <span class="badge badge-warning text-uppercase">
                            {{ $pengaduan->status }}
                        </span>
                    @endif
                    
                    @if($pengaduan->status == 'spam')
                        <span class="badge badge-danger text-uppercase">
                            {{ $pengaduan->status }}
                        </span>
                    @endif
                </div>

                <div class="card-footer text-center">
                    @if(Auth::guard('petugas')->check())
                        @if(Auth::guard('petugas')->user()->level == 'Admin' && Auth::guard('petugas')->user()->status == 1)
                            <a href="{{ route('admin.pengaduan.index') }}">
                                <button class="btn btn-secondary btn-sm">Back</button>
                            </a>
                        @else
                            <a href="{{ route('petugas.pengaduan.index') }}">
                                <button class="btn btn-secondary btn-sm">Back</button>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('masyarakat.pengaduan.index') }}">
                            <button class="btn btn-secondary btn-sm">Back</button>
                        </a>
                    @endif
                </div>
            </div>

            @if(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->status == 1)
                <div class="card mb-4">
                    <div class="card-header">
                        Berikan Tanggapan
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pengaduan.tanggapan.store', $pengaduan->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="tanggapan" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Tanggapan') }}
                                </label>
                                <div class="col-md-6">
                                    <textarea id="tanggapan" name="tanggapan" class="form-control @error('tanggapan') is-invalid @enderror" required rows="5">{{ old('tanggapan') }}</textarea>
                                    @error('tanggapan')
                                        <span class="invalid-tanggapan" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Status') }}
                                </label>

                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="">Please Select</option>
                                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>
                                            Proses
                                        </option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option val ue="spam" {{ old('status') == 'spam' ? 'selected' : '' }}>
                                            Spam
                                        </option>
                                    </select>

                                    @error('status')
                                        <span class="invalid-pengaduan" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0"> 
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if($pengaduan->tanggapan)
                @if ($pengaduan->tanggapan->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header">
                            Tanggapan
                        </div>
                        <div class="card-body">
                            @foreach ($pengaduan->tanggapan as $response)
                                <div class="mb-4">
                                    <span class="text-muted">
                                        [{{ $response->tgl_tanggapan }}]
                                    </span>
                                    <span>
                                        {{ $response->tanggapan }}
                                    </span>
                                    <strong>
                                        ({{ $response->status }})
                                    </strong>

                                    <form action="{{ route('admin.tanggapan.destroy', $response->id) }}" method="post" class="float-right">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="card mb-4">
                        <div class="card-header">
                            Tanggapan
                        </div>
                        <div class="card-body">
                            Belum ada tanggapan.
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection