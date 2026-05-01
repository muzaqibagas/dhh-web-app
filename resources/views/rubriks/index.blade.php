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

            <!-- BTN BERANDA ===================== -->
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
            
            <!-- PEMBATAS EMAS ===================== -->
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>


            <!-- BTN Profile MHS ===================== -->
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

            <!-- BTN LOGOUT ===================== -->
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
                    <h2 class="adm-title">Rubriks</h2>
                    <div class="d-flex justify-content-end align-items-center gap-2">
                    <form action="{{ route('rubrik.index') }}" method="GET" class="d-flex align-items-center gap-2 w-50">
                        <input type="text" name="search" class="form-control" placeholder="Cari Rubrik..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary px-3">
                        <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('rubrik.create') }}" class="adm-btn-add text-decoration-none">
                        <i class="bi bi-plus"></i> Tambah Data
                    </a>
                    </div>
                </div>
                {{-- Alert Success --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif
                {{-- Alert Error --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
                @endif     
                {{-- Alert Info --}}
                @if(session('info'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    {{ session('info') }}
                    </div>
                @endif    
            </div>            
            <table style="
                width:100%;
                border-collapse:collapse;
                background-color:#ffffff;
                border-radius:8px;
                overflow:hidden;
                box-shadow:0 2px 6px rgba(0,0,0,0.08);
            ">
                <thead style="background-color:#1e3a8a; color:#ffffff;">
                    <tr>
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">No</th>                        
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Nama Rubrik</th>                        
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Bobot</th>                        
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Jenis Sidang</th>                        
                        <th style="padding:12px 14px; font-size:14px; text-align:left;">Aksi</th>                        
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    <tbody>
                        @forelse($rubriks as $rubrik)
                            <tr style="background-color:#ffffff;">
                                <td style="padding:12px 14px;">{{ $no++ }}</td>
                                <td style="padding:12px 14px;">{{ $rubrik->nama_kriteria }}</td>
                                <td style="padding:12px 14px;">{{ $rubrik->bobot }}%</td>
                                <td style="padding:12px 14px;">{{ $rubrik->jenis_sidang }}</td>
                                <td style="padding:12px 14px;">
                                    <a href="{{ route('rubrik.edit', $rubrik->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a href="{{ route('rubrik.destroy', $rubrik->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rubrik ini?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                         <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada rubriks.</td>
                        </tr>
                        @endforelse
                    </tbody>                
                </thead>
            </table>        
            <div class="d-flex justify-content-end mt-3">
                {{ $rubriks->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>    
        </main>        
    </div>
@push('script')
@endpush
@endsection
