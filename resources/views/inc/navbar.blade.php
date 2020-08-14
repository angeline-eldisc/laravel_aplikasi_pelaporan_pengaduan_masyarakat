<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0)">
            {{ config('app.name', 'Pengaduan Masyarakat') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Auth::guard('petugas')->check())
                    @if(Auth::guard('petugas')->user()->level == 'Admin' && Auth::guard('petugas')->user()->status == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Manage Users') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">Admin</a>
                                <a class="dropdown-item" href="{{ route('admin.users.indexPetugas') }}">{{ __('Petugas') }}</a>
                                <a class="dropdown-item" href="{{ route('admin.users.indexMasyarakat') }}">{{ __('Masyarakat') }}</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.pengaduan.index') }}">{{ __('Pengaduan') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.laporan') }}">{{ __('Laporan') }}</a>
                        </li>
                    @elseif(Auth::guard('petugas')->user()->level == 'Petugas' && Auth::guard('petugas')->user()->status == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('petugas.pengaduan.index') }}">{{ __('Pengaduan') }}</a>
                        </li>
                    @endif
                @elseif(Auth::guard('masyarakat')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('masyarakat.home') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('masyarakat.pengaduan.index') }}">{{ __('Pengaduan') }}</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->status == 1)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::guard('petugas')->check()) {{ Auth::guard('petugas')->user()->nama }}  @endif<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                            @if (Auth::guard('petugas')->user()->level == 'Admin')
                                <a href="{{route('admin.home')}}" class="dropdown-item">Dashboard</a>
                            @else
                                <a href="{{route('petugas.home')}}" class="dropdown-item">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                                Logout
                            </a>
                            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @elseif(Auth::guard('masyarakat')->check())
                    <li class="nav-item dropdown">
                        <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::guard('masyarakat')) {{ Auth::guard('masyarakat')->user()->nama }}  @endif<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                            <a href="{{route('masyarakat.home')}}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#masyarakat-logout-form').submit();">
                                Logout
                            </a>
                            <form id="masyarakat-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ URL('/masyarakat/registerMasyarakatForm') }}">Register as Masyarakat</a>
                            <a class="dropdown-item" href="{{ URL('/petugas/registerAdminForm') }}">Register as Admin</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>  