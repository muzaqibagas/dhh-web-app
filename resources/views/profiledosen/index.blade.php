@extends('layouts.apps')

@section('content')
    <!-- SIDEBAR -->
    <div class="main-container">
        <aside class="sidebar">
            <div class="d-flex align-items-center menu pb-0 mb-0 pt-0 mt-0">
                <h5 class="fw-bold" style="color: #721B29">{{ Auth::guard('staff')->user()->nama ?? 'Guest' }}</h5>
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
                $isProfileMahasiswaActive =
                    Request::is('profiledosen') ||
                    Request::is('user/*/edit') ||
                    Request::is('profiledosen/edit') ||
                    Request::is('editpassdosen');
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
            <a href="{{ route('penilaian.index') }}" class="menu {{ $isPenilaianActive ? 'active' : '' }}">
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
            <a href="#" class="menu {{ $isProfileMahasiswaActive ? 'active' : '' }}" data-dropdown="profiledosen">
                <div class="menu-left">
                    <i class="bi bi-person"></i>
                    <span> Profil Dosen </span>
                </div>
                <span class="dropdownArrow" data-arrow="profiledosen">
                    {!! $isProfileMahasiswaActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="profiledosen"
                style="margin-left:24px; flex-direction:column; {{ $isProfileMahasiswaActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/profiledosen"
                    class="submenu-link {{ Request::is('profiledosen', 'profiledosen/edit', 'user/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-person-workspace"></i> Biodata Dosen
                </a>
                <a href="/editpassdosen" class="submenu-link {{ Request::is('editpassdosen') ? 'active-submenu' : '' }}">
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
            <div style="background:#fff; padding:24px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.08); max-width:800px; margin:auto;"
                class="shadow">
                <!-- Header -->
                <div style="display:flex; align-items:center; gap:20px; margin-bottom:24px;">
                    <div
                        style="width:90px; height:90px; border-radius:50%; background:#c7d2fe; display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:bold; color:#1e3a8a;">
                        @if ($user->foto)
                            <img id="preview-image" src="{{ asset(trim($user->foto)) }}" alt=""
                                class="w-100 h-100 object-fit-cover rounded-circle">
                        @else
                            <img id="preview-image" src="{{ asset('img/default.jpeg') }}" alt=""
                                class="w-100 h-100 object-fit-cover rounded-circle">
                        @endif
                    </div>
                    <div>
                        <h3 style="margin:0; font-size:18px;">{{ $user->nama }}</h3>
                    </div>
                </div>

                <!-- Detail Profil -->
                <table style="width:100%; border-collapse:collapse; margin-top:10px;">
                    <tr>
                        <td style="padding:10px; font-weight:bold; color:#444; width:200px;">NIP</td>
                        <td style="padding:10px;">:</td>
                        <td style="padding:10px;">{{ $user->nip }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px; font-weight:bold; color:#444;">Email</td>
                        <td style="padding:10px;">:</td>
                        <td style="padding:10px;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px; font-weight:bold; color:#444;">Jabatan</td>
                        <td style="padding:10px;">:</td>
                        <td style="padding:10px;">{{ $user->jabatan }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px; font-weight:bold; color:#444;">Divisi</td>
                        <td style="padding:10px;">:</td>
                        <td style="padding:10px;">{{ $user->divisi->nama }}</td>
                    </tr>
                </table>

                <!-- Button -->
                <!-- <button
                        style="
                    background:#2563eb;
                    color:#fff;
                    padding:10px 20px;
                    border:none;
                    border-radius:6px;
                    cursor:pointer;
                    font-size:14px;
                    margin-top:20px;
                ">
                    Edit Profil
                </button> -->
            </div>
        </main>
    </div>
    @push('script')
        <script>
            document.querySelectorAll('[data-dropdown]').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();

                    const target = this.getAttribute('data-dropdown');
                    const menu = document.querySelector(`[data-menu="${target}"]`);
                    const arrow = document.querySelector(`[data-arrow="${target}"]`);
                    const isOpen = menu.style.display === 'flex';

                    // Tutup semua dulu
                    document.querySelectorAll('[data-menu]').forEach(m => m.style.display = 'none');
                    document.querySelectorAll('[data-arrow]').forEach(a => a.innerHTML = '&#9650;');

                    // Kalau belum terbuka, buka
                    if (!isOpen) {
                        menu.style.display = 'flex';
                        arrow.innerHTML = '&#9660;';
                    }
                });
            });
        </script>
    @endpush
@endsection
