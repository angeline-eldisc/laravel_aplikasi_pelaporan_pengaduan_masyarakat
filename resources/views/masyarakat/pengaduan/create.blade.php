@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Laporkan Pengaduhan
                    </div>
                    <div class="card-body">
                        @include('inc.alerts')
                        <form method="POST" action="{{ route('masyarakat.pengaduan.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                            <div class="form-group row">
                                <label for="isi_laporan" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Laporan') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="isi_laporan" name="isi_laporan" class="form-control @error('isi_laporan') 'is-invalid' @enderror" required rows="5">{{ old('isi_laporan') }}</textarea>
                                    @error('isi_laporan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="foto" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Foto') }}
                                </label>

                                <div class="col-md-6">
                                    <img width="200" height="150" />
                                    <input type="file" class="uploads form-control @error('foto') 'is-invalid' @enderror" style="margin-top: 20px;" name="foto" id="foto">
                                </div>

                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('masyarakat.pengaduan.index') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection