<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                        <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'kepala')
                <li class="nav-item" ><a class="nav-link" href="{{ route('dashboard') }}"><i class="feather icon-home"></i><span>Dashboard</span></a></li>
                @endif

                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-bar-chart-2"></i><span data-i18n="Master Data">Master Data</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->role == 'admin')
                        <li data-menu=""><a class="dropdown-item" href="{{ route('users.index') }}">Data Login</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="{{ route('pegawai.index') }}">Data Pegawai</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="{{ route('dokter.index') }}">Data Dokter</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="{{ route('poli.index') }}">Data Poli</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'dokter')
                        <li data-menu=""><a class="dropdown-item" href="">Data Pemeriksaan</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'apoteker')
                        <li data-menu="{{ route('obat.index') }}"><a class="dropdown-item" href="">Data Obat</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'staf')
                        <li data-menu=""><a class="dropdown-item" href="">Data Diagnosa</a>
                        </li>
                        @endif
                    </ul>
                </li>

                @if(Auth::user()->role == 'staf')
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-users"></i><span>Pendaftaran</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item" href="{{route('kepalaKeluarga.index')}}">Data Kepala Keluarga</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="{{route('pasien.index')}}">Data Pasien</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="{{ route('kunjungan.index') }}">Data Kunjungan</a>
                        </li>
                    </ul>
                </li>
                @endif
            
                @if(Auth::user()->role == 'apoteker')
                <li class="nav-item" ><a class="nav-link" href=""><i class="feather icon-airplay"></i><span>Unit Apotek</span></a></li>
                @endif

                {{--<li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-file-text"></i><span>Rekap Medis</span></a>
                    <ul class="dropdown-menu">
                        <li data-menu=""><a class="dropdown-item" href="">Pemeriksaan Awal</a>
                        </li>
                        <li data-menu=""><a class="dropdown-item" href="">Pemeriksaan Lanjutan</a>
                        </li>
                    </ul>
                </li>--}}
                
                @if(Auth::user()->role == 'staf') 
                <li class="nav-item" ><a class="nav-link" href="{{ route('antrian.index') }}"><i class="feather icon-airplay"></i><span>Antrian</span></a></li>
                @endif

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'kepala')
                <li class="nav-item" ><a class="nav-link" href=""><i class="feather icon-printer"></i><span>Laporan</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>