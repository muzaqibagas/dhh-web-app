@extends('layouts.apps')

@section('content')

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

        <main class="content">
            <div class="card text-start mb-4 p-4" style="background:#f3f4f6;">
                <h2 style="font-size:18px; color:#1e3a8a;">
                    Informasi Mahasiswa
                </h2>

                <table class="info-table">
                    <tr>
                        <td>Nama Mahasiswa</td>
                        <td>:</td>
                        <td>{{ $ujians->first()->mahasiswa->nama ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{ $ujians->first()->mahasiswa->nim ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            @forelse($ujians as $ujian)
                @php
                    $hasModerator = $ujian->penilaian->whereNotNull('id_moderator')->isNotEmpty();

                    $hasPembimbing1 = $ujian->penilaian->whereNotNull('id_pembimbing1')->isNotEmpty();

                    $hasPembimbing2 = $ujian->penilaian->whereNotNull('id_pembimbing2')->isNotEmpty();

                    $hasPenguji = $ujian->penilaian->whereNotNull('id_penguji')->isNotEmpty();

                    $groupedRubrik = $ujian->penilaian->groupBy('id_rubrik');

                    $judul = match ($ujian->jenis_ujian) {
                        'kolokium' => $ujian->kolokiummhs->judul_kolokium ?? '-',

                        'seminar' => $ujian->seminarmhs->judul_seminar ?? '-',

                        'komprehensif' => $ujian->komprehensifmhs->judul_komprehensif ?? '-',

                        default => '-',
                    };
                @endphp

                <div class="card text-start mb-4 p-4">
                    <div
                        style="
                            background:#dbeafe;
                            padding:14px 18px;
                            border-radius:8px;
                            margin-bottom:20px;
                        ">
                        <h4 style="margin:0; color:#1e3a8a; font-weight:bold;">
                            @if ($ujian->jenis_ujian == 'kolokium')
                                Kolokium
                            @elseif($ujian->jenis_ujian == 'seminar')
                                Seminar Hasil
                            @else
                                Komprehensif
                            @endif
                        </h4>

                        <strong style="color:#475569;">Judul TA :</strong>
                        <strong style="color:#475569;">{{ $judul }}</strong>
                    </div>

                    <table
                        style="
                            width:100%;
                            border-collapse:collapse;
                            background-color:#ffffff;
                            border-radius:8px;
                            overflow:hidden;
                            box-shadow:0 2px 10px rgba(0,0,0,0.08);
                        ">
                        <thead style="background-color:#1e3a8a; color:#ffffff;">
                            <tr>
                                <th style="padding:12px 14px; text-align:left;">No</th>
                                <th style="padding:12px 14px; text-align:left;">Komponen Penilaian</th>
                                <th style="padding:12px 14px; text-align:left;">Bobot</th>

                                @if ($hasModerator)
                                    <th style="padding:12px 14px; text-align:left;">
                                        {{ $ujian->jenis_ujian == 'komprehensif' ? 'Ketua Sidang' : 'Moderator' }}
                                    </th>
                                @endif

                                @if ($hasPembimbing1)
                                    <th style="padding:12px 14px; text-align:left;">Pembimbing 1</th>
                                @endif

                                {{-- PEMBIMBING 2 --}}
                                @if ($hasPembimbing2)
                                    <th style="padding:12px 14px; text-align:left;">Pembimbing 2</th>
                                @endif

                                {{-- PENGUJI --}}
                                @if ($hasPenguji)
                                    <th style="padding:12px 14px; text-align:left;">Penguji</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedRubrik as $index => $items)
                                @php
                                    $first = $items->first();
                                    $moderator = $items->firstWhere('id_moderator', '!=', null);
                                    $pembimbing1 = $items->firstWhere('id_pembimbing1', '!=', null);
                                    $pembimbing2 = $items->firstWhere('id_pembimbing2', '!=', null);
                                    $penguji = $items->firstWhere('id_penguji', '!=', null);
                                    $nilaiMap = [
                                        1 => '1 - Kurang',
                                        2 => '2 - Cukup',
                                        3 => '3 - Baik',
                                        4 => '4 - Sangat Baik',
                                    ];
                                @endphp

                                <tr style="border-bottom:1px solid #e5e7eb;">
                                    <td style="padding:12px 14px;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td style="padding:12px 14px;">{{ $first->rubrik->nama_kriteria ?? '-' }}</td>
                                    <td style="padding:12px 14px;">{{ $first->rubrik->bobot ?? '-' }}%</td>
                                    @if ($hasModerator)
                                        <td style="padding:12px 14px;">
                                            {{ $moderator ? $nilaiMap[$moderator->nilai] ?? '-' : '-' }}</td>
                                    @endif

                                    @if ($hasPembimbing1)
                                        <td style="padding:12px 14px;">
                                            {{ $pembimbing1 ? $nilaiMap[$pembimbing1->nilai] ?? '-' : '-' }}</td>
                                    @endif

                                    @if ($hasPembimbing2)
                                        <td style="padding:12px 14px;">
                                            {{ $pembimbing2 ? $nilaiMap[$pembimbing2->nilai] ?? '-' : '-' }}</td>
                                    @endif

                                    @if ($hasPenguji)
                                        <td style="padding:12px 14px;">
                                            {{ $penguji ? $nilaiMap[$penguji->nilai] ?? '-' : '-' }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @php
                        $nilaiModerator = $ujian->penilaian
                            ->whereNotNull('id_moderator')
                            ->pluck('nilai_akhir')
                            ->filter()
                            ->first();
                        $nilaiPembimbing1 = $ujian->penilaian
                            ->whereNotNull('id_pembimbing1')
                            ->pluck('nilai_akhir')
                            ->filter()
                            ->first();
                        $nilaiPembimbing2 = $ujian->penilaian
                            ->whereNotNull('id_pembimbing2')
                            ->pluck('nilai_akhir')
                            ->filter()
                            ->first();
                        $nilaiPenguji = $ujian->penilaian
                            ->whereNotNull('id_penguji')
                            ->pluck('nilai_akhir')
                            ->filter()
                            ->first();

                        $semuaNilai = collect([
                            $nilaiModerator,
                            $nilaiPembimbing1,
                            $nilaiPembimbing2,
                            $nilaiPenguji,
                        ])->filter();

                        $rataRata = $semuaNilai->isNotEmpty() ? $semuaNilai->avg() : null;

                    @endphp

                    <div
                        style="
                            margin-top:16px;
                            padding:16px;
                            background:#eef2ff;
                            border-radius:8px;
                            font-size:14px;
                        ">

                        {{-- MODERATOR --}}
                        @if ($nilaiModerator)
                            <div class="mb-2">

                                <strong>
                                    {{ $ujian->jenis_ujian == 'komprehensif' ? 'Nilai Ketua Sidang' : 'Nilai Moderator' }}
                                    :
                                </strong>

                                {{ number_format($nilaiModerator, 2) }}

                            </div>
                        @endif

                        {{-- PEMBIMBING 1 --}}
                        @if ($nilaiPembimbing1)
                            <div class="mb-2">

                                <strong>Nilai Pembimbing 1 :</strong>

                                {{ number_format($nilaiPembimbing1, 2) }}

                            </div>
                        @endif

                        {{-- PEMBIMBING 2 --}}
                        @if ($nilaiPembimbing2)
                            <div class="mb-2">

                                <strong>Nilai Pembimbing 2 :</strong>

                                {{ number_format($nilaiPembimbing2, 2) }}

                            </div>
                        @endif

                        {{-- PENGUJI --}}
                        @if ($nilaiPenguji)
                            <div class="mb-2">

                                <strong>Nilai Penguji :</strong>

                                {{ number_format($nilaiPenguji, 2) }}

                            </div>
                        @endif

                        {{-- RATA-RATA --}}
                        <hr>

                        <div>

                            <strong>Rata-rata Nilai :</strong>

                            {{ $rataRata ? number_format($rataRata, 2) : '-' }}

                        </div>

                    </div>

                </div>
            @empty

                <div class="card text-start mb-4 p-4">
                    Tidak ada data penilaian.
                </div>
            @endforelse
        </main>
    </div>
@endsection
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
