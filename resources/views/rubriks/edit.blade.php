@extends('layouts.apps')

@section('content')
    <div class="main-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="d-flex align-items-center menu pb-0 mb-0 pt-0 mt-0">
                <h5 class="fw-bold" style="color: #721B29">
                    @if(Auth::guard('staff')->check())
                        {{ Auth::guard('staff')->user()->username }}
                    @elseif(Auth::check())
                        {{ Auth::user()->username }}
                    @else
                        Guest
                    @endif
                </h5>        
            </div>
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>

            <!-- Untuk aktifin button sub menu ========================= -->
            @php
                $isDashboardActive = Request::is('dashboarddosen');
                $isJadwalTAActive = Request::is('jadwalta');
                $isPenilaianActive = Request::is('penilaian');
                $isFormulirLayananActive = Request::is('formulirlayananakademikmhs');        
                $isProfileMahasiswaActive = Request::is('profilemhs') || Request::is('user/*/edit') || Request::is('profilemhs/edit') || Request::is('editpassmhs');
                $isLogoutmhsActive = Request::is('logoutmhs');
                @endphp

            <!-- BTN BERANDA -->
            <a href="{{ route('dashboarddosen.index') }}" class="menu {{ $isDashboardActive ? 'active' : '' }}">
                <div class="menu-left">
                <i class="bi bi-house-door-fill"></i>
                <span> Beranda </span>
                </div>
            </a>
            <a href="{{ route('jadwalta.index') }}" class="menu {{ $isJadwalTAActive ? 'active' : '' }}">
                <div class="menu-left">          
                <i class="bi bi-calendar-event-fill"></i>
                <span> Jadwal TA </span>
                </div>
            </a>
            <a href="{{ route('penilaian.create') }}" class="menu {{ $isPenilaianActive ? 'active' : '' }}">
                <div class="menu-left">          
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span> Penilaian </span>
                </div>
            </a>
                        
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>

            <!-- BTN Profile MHS -->
            <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profilemhs">
                <div class="menu-left">
                <i class="bi bi-person"></i>
                <span> Profil Mahasiswa </span>
                </div>
                <span class="dropdownArrow" data-arrow="profilemhs">
                {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="profilemhs"
                style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/profilemhs"
                class="submenu-link {{ Request::is('profilemhs', 'profilemhs/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
                <i class="bi bi-person-workspace"></i> Biodata Mahasiswa
                </a>
                <a href="/editpassmhs"
                class="submenu-link {{ Request::is('editpassmhs') ? 'active-submenu' : '' }}">
                <i class="bi bi-gear-wide-connected"></i> Edit Password
                </a>
            </div>

            <!-- BTN LOGOUT -->
            <form action="{{ route('login.logout') }}" method="POST" class="menu p-0 m-0">
                @csrf
                <button type="submit" class="menu w-100 text-start border-0 bg-transparent">
                    <div class="menu-left">
                        <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
                    </div>
                </button>
            </form>      
        </aside>                 
        <main class="content">
            <div class="container-fluid mt-4">
                <div class="adm-header">
                    <h2 class="adm-title">Edit Rubrik</h2>
                </div> 
                @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">

                        <form action="{{route('rubrik.update', $rubrik->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="nama_kriteria" class="col-form-label">Nama Kriteria</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="nama_kriteria" class="form-control shadow-sm" id="nama_kriteria" value="{{ $rubrik->nama_kriteria }}" placeholder="Nama Kriteria..." required>
                            </div>
                        </div>
                        <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="bobot" class="col-form-label">Bobot (%)</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" name="bobot" class="form-control shadow-sm" id="bobot" value="{{ $rubrik->bobot }}" placeholder="Bobot..." required>
                            </div>
                        </div>
                        <div class="text-start row row-cols-1 row-cols-sm-2 align-items-center mb-3">
                            <div class="col-sm-2">
                                <label for="jenis_sidang" class="col-form-label">Jenis Sidang</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="jenis_sidang" class="form-control shadow-sm" id="jenis_sidang" value="{{ $rubrik->jenis_sidang }}" required>
                                    <option value="kolokium">Kolokium</option>
                                    <option value="seminar">Seminar Hasil</option>
                                    <option value="komprehensif">Komprehensif</option>
                                </select>
                            </div>
                        </div>
                        <!-- Tombol simpan -->
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </main>
    </div>
@push('script')
@endpush
@endsection
