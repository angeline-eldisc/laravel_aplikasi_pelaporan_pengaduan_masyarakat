@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Auth::guard('masyarakat')->check())
                <a href="{{ route('masyarakat.pengaduan.create') }}">
                    <button class="btn btn-primary mb-3">Laporkan Pengaduhan</button>
                </a>
            @endif

            @if($pengaduan->count() > 0)
                @foreach ($pengaduan as $p)
                    <div class="card mb-4">
                        <div class="card-header">
                            @if(Auth::guard('petugas')->check())
                                @if(Auth::guard('petugas')->user()->level == 'Admin' && Auth::guard('petugas')->user()->status == 1)
                                    <a href="{{ route('admin.pengaduan.show', $p->id) }}" style="text-decoration: none;">
                                        {{ $p->masyarakat->nama }} - {{ $p->tgl_pengaduan }}
                                    </a>
                                @elseif(Auth::guard('petugas')->user()->level == 'Petugas' && Auth::guard('petugas')->user()->status == 1)
                                    <a href="{{ route('petugas.pengaduan.show', $p->id) }}" style="text-decoration: none;">
                                        {{ $p->masyarakat->nama }} - {{ $p->tgl_pengaduan }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('masyarakat.pengaduan.show', $p->id) }}" style="text-decoration: none;">
                                    {{ $p->masyarakat->nama }} - {{ $p->tgl_pengaduan }}
                                </a>
                            @endif

                            @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->status == 1)
                                @if(Auth::guard('petugas')->user()->level == 'Admin')
                                <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="post" class="float-right">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                                </form>
                                @elseif(Auth::guard('petugas')->user()->level == 'Petugas')
                                <form action="{{ route('petugas.pengaduan.destroy', $p->id) }}" method="post" class="float-right">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                                </form>
                                @endif
                            @endif
                        </div>

                        <div class="card-body">
                            {{ $p->isi_laporan }}
                        </div>

                        @if ($p->foto)
                            <img src="{{ asset($p->foto) }}" height="350" alt="Lampiran">
                        @endif

                        <div class="card-body">
                            @if($p->status == 'selesai')
                                <span class="badge badge-success text-uppercase">
                                    {{ $p->status }}
                                </span>
                            @endif

                            @if($p->status == 'proses')
                                <span class="badge badge-warning text-uppercase">
                                    {{ $p->status }}
                                </span>
                            @endif
                            
                            @if($p->status == 'spam')
                                <span class="badge badge-danger text-uppercase">
                                    {{ $p->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach

            {{ $pengaduan->appends(request()->only(['status', 'masyarakat_id']))->links() }}
            @else
                <div class="card mb-4">
                    <div class="card-header">
                        Pengaduhan
                    </div>

                    <div class="card-body">
                        Tidak ada pengaduan.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
