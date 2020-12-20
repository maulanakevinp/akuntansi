<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0 font-weight-900 text-primary" style="font-size: 20pt" href="{{ route('home') }}">
            AKUNTANSI
            {{-- <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="..."> --}}
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            @yield('form-search-mobile')
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'akun' ? 'active' : '' }}" href="{{ route('akun.index') }}">
                        <i class="ni ni-bullet-list-67 text-success"></i> {{ __('Akun') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'jurnal-umum' ? 'active' : '' }}" href="{{ route('jurnal-umum.index') }}">
                        <i class="ni ni-bullet-list-67 text-info"></i> {{ __('Jurnal Umum') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'jurnal-penyesuaian' ? 'active' : '' }}" href="{{ route('jurnal-penyesuaian.index') }}">
                        <i class="ni ni-bullet-list-67 text-indigo"></i> {{ __('Jurnal Penyesuaian') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'buku-besar' ? 'active' : '' }}" href="{{ url('/buku-besar') }}{{ App\Models\Akun::orderBy('kode')->first() ? '?kode_akun=' . App\Models\Akun::orderBy('kode')->first()->kode . '&kriteria=periode&periode=1-bulan-terakhir' : '' }}">
                        <i class="ni ni-bullet-list-67 text-yellow"></i> {{ __('Buku Besar') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'neraca-lajur' ? 'active' : '' }}" href="{{ route('neraca-lajur.index') }}">
                        <i class="ni ni-bullet-list-67 text-warning"></i> {{ __('Neraca Lajur') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'laporan' ? 'active' : '' }}" href="#laporan" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="laporan">
                        <i class="ni ni-bullet-list-67 text-gray"></i> {{ __('Laporan') }}
                    </a>
                    <div class="collapse {{ request()->segment(1) == 'laporan' ? 'show' : '' }}" id="laporan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(2) == 'perubahan-ekuitas' ? 'active' : '' }}" href="{{ route('laporan.perubahan-ekuitas') }}">
                                    Perubahan Ekuitas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(2) == 'laba-rugi' ? 'active' : '' }}" href="{{ route('laporan.laba-rugi') }}">
                                    Laba Rugi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->segment(2) == 'posisi-keuangan' ? 'active' : '' }}" href="{{ route('laporan.posisi-keuangan') }}">
                                    Posisi Keuangan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'jurnal-penutup' ? 'active' : '' }}" href="{{ route('jurnal-penutup.index') }}">
                        <i class="ni ni-bullet-list-67 text-green"></i> {{ __('Jurnal Penutup') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
