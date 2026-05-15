@extends('layouts.apps')

@section('content')
    <!-- SIDEBAR -->
    <div class="main-container">
        <aside class="sidebar">
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/logodashboardadmn.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>
            <!-- Untuk aktifin button sub menu ========================= -->
            @php
                $isDashboardActive = Request::is('dashboardadm');

                $isRecapdataActive = Request::is('recapdata*');

                $isAdminProfileActive =
                    Request::is('admprofile') ||
                    Request::is('user/*/edit') ||
                    Request::is('editpassadm') ||
                    Request::is('logoutadmprofile');

                $isRubrikActive = Request::is('rubrik*');

                $isTingkatAkhirActive =
                    Request::is('syaratkolokiummhs') ||
                    Request::is('syaratkolokiummhs*') ||
                    Request::is('syaratseminarmhs') ||
                    Request::is('syaratseminarmhs*') ||
                    Request::is('syaratkomprehensifmhs') ||
                    Request::is('syaratkomprehensifmhs*');

                $isKontenActive =
                    Request::is('kategorigaleri*') ||
                    Request::is('galeri*') ||
                    Request::is('kategoriartikel*') ||
                    Request::is('artikel*') ||
                    Request::is('review-alumni*') ||
                    Request::is('konten-dept*') ||
                    Request::is('kontenjenjang*') ||
                    Request::is('mitra*');

                $isStaffDeptActive =
                    Request::is('kategoristaff*') || Request::is('staff-dept*') || Request::is('ketuadhh*');
            @endphp

            <!-- BTN Dashboard ===================== -->
            <a href="/dashboardadm" class="menu {{ $isDashboardActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-graph-up"></i> <span> Dasbor </span>
                </div>
                <span class="dropdownArrow"></span>
            </a>

            <!-- BTN RECAP DATA ===================== -->
            <a href="/recapdata" class="menu {{ $isRecapdataActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-database-check"></i> <span> Rekapitulasi Data </span>
                </div>
                <span class="dropdownArrow"></span>
            </a>

            <!-- BTN RUBRIK ===================== -->
            <a href="{{ route('rubrik.index') }}" class="menu {{ $isRubrikActive ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-journal-check"></i><span> Rubrik </span>
                </div>
                <span class="dropdownArrow"></span>
            </a>

            <!-- BTN PENILAIAN ===================== -->
            <a href="{{ route('penilaianadm.index') }}" class="menu {{ Request::is('penilaianadm*') ? 'active' : '' }}">
                <div class="menu-left">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i> <span> Penilaian </span>
                </div>
                <span class="dropdownArrow"></span>
            </a>

            <!-- BTN TINGKAT AKHIR===================== -->
            <a href="#" class="menu {{ $isTingkatAkhirActive ? 'active' : '' }}" data-dropdown="tingkatakhir">
                <div class="menu-left">
                    <i class="bi bi-mortarboard"></i>
                    <span> Tingkat Akhir </span>
                </div>
                <span class="dropdownArrow" data-arrow="tingkatakhir">
                    {!! $isTingkatAkhirActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="tingkatakhir"
                style="margin-left:24px; flex-direction:column; {{ $isTingkatAkhirActive ? 'display:flex;' : 'display:none;' }}">

                {{-- KOLOKIUM --}}
                <a href="{{ route('syaratujian.index', ['jenis' => 'kolokium']) }}"
                    class="submenu-link {{ request('jenis') == 'kolokium' ? 'active-submenu' : '' }}">
                    <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
                </a>

                {{-- SEMINAR --}}
                <a href="{{ route('syaratujian.index', ['jenis' => 'seminar']) }}"
                    class="submenu-link {{ request('jenis') == 'seminar' ? 'active-submenu' : '' }}">
                    <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
                </a>

                {{-- KOMPRE --}}
                <a href="{{ route('syaratujian.index', ['jenis' => 'komprehensif']) }}"
                    class="submenu-link {{ request('jenis') == 'komprehensif' ? 'active-submenu' : '' }}">
                    <i class="bi bi-journal-text"></i> Data Pendaftar Sidang
                </a>
            </div>

            <!-- BTN KONTEN ===================== -->
            <a href="#" class="menu {{ $isKontenActive ? 'active' : '' }}" data-dropdown="konten">
                <div class="menu-left">
                    <i class="bi bi-collection"></i>
                    <span> Konten </span>
                </div>
                <span class="dropdownArrow" data-arrow="konten">
                    {!! $isKontenActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="konten"
                style="margin-left:24px; flex-direction:column; {{ $isKontenActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/kategorigaleri"
                    class="submenu-link {{ Request::is('kategorigaleri', 'kategorigaleri/create', 'kategorigaleri/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-clipboard-check"></i> Kategori Galeri
                </a>
                <a href="/galeri"
                    class="submenu-link {{ Request::is('galeri', 'galeri/create', 'galeri/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-images"></i> Galeri
                </a>
                <a href="/kategoriartikel"
                    class="submenu-link {{ Request::is('kategoriartikel', 'kategoriartikel/create', 'kategoriartikel/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-clipboard-check"></i> Kategori Artikel
                </a>
                <a href="/artikel"
                    class="submenu-link {{ Request::is('artikel', 'artikel/create', 'artikel/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-layout-text-window"></i> Artikel
                </a>
                <a href="/review-alumni"
                    class="submenu-link {{ Request::is('review-alumni', 'review-alumni/create', 'review-alumni/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-star"></i> Review Alumni
                </a>
                <a href="/konten-dept"
                    class="submenu-link {{ Request::is('konten-dept', 'konten-dept/show', 'konten-dept/*/edit', 'konten-dept/create') ? 'active-submenu' : '' }}">
                    <i class="bi bi-laptop"></i> Konten Departemen
                </a>
                <a href="/kontenjenjang"
                    class="submenu-link {{ Request::is('kontenjenjang', 'kontenjenjang/show', 'kontenjenjang/*/edit', 'kontenjenjang/create') ? 'active-submenu' : '' }}">
                    <i class="bi bi-house-door"></i> Konten Jenjang
                </a>
                <a href="/mitra"
                    class="submenu-link {{ Request::is('mitra', 'mitra/create', 'mitra/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-person-check"></i> Mitra
                </a>
            </div>

            <!-- BTN SDM ===================== -->
            <a href="#" class="menu {{ $isStaffDeptActive ? 'active' : '' }}" data-dropdown="staffdept">
                <div class="menu-left">
                    <i class="bi bi-people-fill"></i>
                    <span> Sumber Daya Manusia </span>
                </div>
                <span class="dropdownArrow" data-arrow="staffdept">
                    {!! $isStaffDeptActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="staffdept"
                style="margin-left:24px; flex-direction:column; {{ $isStaffDeptActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/kategoristaff"
                    class="submenu-link {{ Request::is('kategoristaff', 'kategoristaff/create', 'kategoristaff/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-envelope-open"></i> Kategori Staff Departemen
                </a>
                <a href="/staff-dept"
                    class="submenu-link {{ Request::is('staff-dept', 'staff-dept/create', 'staff-dept/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-check2-circle"></i> Staff Departemen
                </a>
                <a href="/ketuadhh"
                    class="submenu-link {{ Request::is('ketuadhh', 'ketuadhh/create', 'ketuadhh/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-calendar-event"></i> Ketua DHH
                </a>
            </div>

            <!-- PEMBATAS EMAS ===================== -->
            <a href="" class="menu-image-only">
                <img src="{{ asset('img/batasgold.png') }}" alt="Layanan Akademik" class="menu-img">
            </a>

            <!-- BTN ADMIN ===================== -->
            <a href="#" class="menu {{ $isAdminProfileActive ? 'active' : '' }}" data-dropdown="admprofile">
                <div class="menu-left">
                    <i class="bi bi-person-badge"></i>
                    <span> Profil Admin </span>
                </div>
                <span class="dropdownArrow" data-arrow="admprofile">
                    {!! $isAdminProfileActive ? '&#9660;' : '&#9650;' !!}
                </span>
            </a>
            <div data-menu="admprofile"
                style="margin-left:24px; flex-direction:column; {{ $isAdminProfileActive ? 'display:flex;' : 'display:none;' }}">
                <a href="/admprofile"
                    class="submenu-link {{ Request::is('admprofile', 'user/*/edit') ? 'active-submenu' : '' }}">
                    <i class="bi bi-person-workspace"></i> Detail Profil Admin
                </a>
                <a href="/editpassadm" class="submenu-link {{ Request::is('editpassadm') ? 'active-submenu' : '' }}">
                    <i class="bi bi-gear-wide-connected"></i> Ubah Kata Sandi
                </a>
                <form action="{{ route('login.logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit"
                        class="submenu-link w-100 text-start{{ Request::is('logoutadmprofile') ? 'active-submenu' : '' }}">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN DEPARTEMEN -->
        <main class="content">
            <div class="container-fluid mt-4">
                <div class="adm-header">
                    <h2 class="adm-title">Tambah Konten Departemen</h2>
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('konten-dept.store') }}" method="POST">
                            @csrf
                            <!-- Sejarah -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label fw-bold text-start">Sejarah</label>
                                <div class="col-sm-10">
                                    <textarea name="sejarah" rows="4" class="form-control" placeholder="Sejarah..." required>{{ old('sejarah') }}</textarea>
                                </div>
                            </div>

                            <!-- Visi -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label fw-bold text-start">Visi</label>
                                <div class="col-sm-10">
                                    <textarea name="visi" rows="3" class="form-control" placeholder="Visi..." required>{{ old('visi') }}</textarea>
                                </div>
                            </div>

                            <!-- Misi -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label fw-bold text-start">Misi</label>
                                <div class="col-sm-10">
                                    <textarea name="misi" rows="3" class="form-control" placeholder="Misi..." required>{{ old('misi') }}</textarea>
                                </div>
                            </div>

                            <!-- Tujuan -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label fw-bold text-start">Tujuan</label>
                                <div class="col-sm-10">
                                    <textarea name="tujuan" rows="6" class="form-control" placeholder="Tujuan..." required>{{ old('tujuan') }}</textarea>
                                </div>
                            </div>

                            <!-- Kebijakan Mutu -->
                            <div class="row mb-3 align-items-center">
                                <label class="col-sm-2 col-form-label fw-bold text-start">Kebijakan Mutu</label>
                                <div class="col-sm-10">
                                    <textarea name="kebijakanmutu" rows="5" class="form-control" placeholder="Kebijakan Mutu..." required>{{ old('kebijakanmutu') }}</textarea>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4 me-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>

                        </form>
                    </div>
                </div>
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
