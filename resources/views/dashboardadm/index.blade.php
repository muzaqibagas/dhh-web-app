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

        <main class="content px-4 py-4">
            <h2 class="text-center fw-bold mb-4" style="color:#6b1414;">Dasbor Admin</h2>
            <!-- FILTER TAHUN AJARAN -->
            <div class="mb-4 d-flex justify-content-end">
                <form method="GET" action="{{ route('dashboardadm.index') }}" class="d-flex align-items-center gap-2">
                    <label for="tahun_ajaran" class="me-2" style="white-space: nowrap;">Tahun Ajaran</label>
                    <select id="tahun_ajaran" name="tahun_ajaran" class="form-select">
                        <option value="">(Default: tahun sekarang)</option>
                        @php
                            $now = \Carbon\Carbon::now()->year;
                        @endphp
                        @for ($y = $now; $y >= $now - 4; $y--)
                            <option value="{{ $y }}/{{ $y + 1 }}"
                                {{ request('tahun_ajaran') == "$y/" . ($y + 1) ? 'selected' : '' }}>
                                {{ $y }}/{{ $y + 1 }}
                            </option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>

            <!-- DATA PENDAFTAR KOLOKIUM -->
            <div class="d-flex gap-2 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center">
                        <h5 class="fw-bold" style="color:#6b1414;">Pendaftar Kolokium</h5>
                        <h2 class="fw-bold mb-0" style="color:#6b1414;">{{ $jumlahKolokium }}</h2>
                        <p class="text-secondary mb-0">Mahasiswa</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center">
                        <h5 class="fw-bold" style="color:#6b1414;">Pendaftar Seminar Hasil</h5>
                        <h2 class="fw-bold mb-0" style="color:#6b1414;">{{ $jumlahSeminar }}</h2>
                        <p class="text-secondary mb-0">Mahasiswa</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center">
                        <h5 class="fw-bold" style="color:#6b1414;">Pendaftar Komprehensif</h5>
                        <h2 class="fw-bold mb-0" style="color:#6b1414;">{{ $jumlahKompre }}</h2>
                        <p class="text-secondary mb-0">Mahasiswa</p>
                    </div>
                </div>
            </div>

            {{-- === GRID CHARTS === --}}
            <div class="d-flex flex-column">
                <div class="d-flex gap-3 mb-4">
                    {{-- Grafik Tren Pendaftar --}}
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm p-3 h-100">
                            <h5 class="fw-bold mb-3" style="color:#6b1414;">Grafik Tren Pendaftar</h5>
                            <canvas id="trendChart" height="200"></canvas>
                        </div>
                    </div>

                    {{-- Verifikasi Tingkat Akhir --}}
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm p-3 h-100">
                            <h5 class="fw-bold mb-3" style="color:#6b1414;">Verifikasi Tingkat Akhir</h5>
                            <div class="d-flex justify-content-around flex-wrap">
                                <div class="text-center my-2">
                                    <canvas id="verifKolokium" width="100" height="100"></canvas>
                                    <p class="fw-semibold mt-2">Kolokium</p>
                                </div>
                                <div class="text-center my-2">
                                    <canvas id="verifSeminar" width="100" height="100"></canvas>
                                    <p class="fw-semibold mt-2">Seminar</p>
                                </div>
                                <div class="text-center my-2">
                                    <canvas id="verifKompre" width="100" height="100"></canvas>
                                    <p class="fw-semibold mt-2">Komprehensif</p>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <div class="d-inline-block mx-2">
                                    <span
                                        style="display:inline-block;width:14px;height:14px;background:#013880;border-radius:3px;margin-right:5px;"></span>
                                    Disetujui
                                </div>
                                <div class="d-inline-block mx-2">
                                    <span
                                        style="display:inline-block;width:14px;height:14px;background:#d9534f;border-radius:3px;margin-right:5px;"></span>
                                    Ditolak
                                </div>
                                <div class="d-inline-block mx-2">
                                    <span
                                        style="display:inline-block;width:14px;height:14px;background:#bfbfbf;border-radius:3px;margin-right:5px;"></span>
                                    Belum diverifikasi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    {{-- Artikel per Kategori --}}
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm p-3 h-100">
                            <h5 class="fw-bold mb-3" style="color:#6b1414;">Artikel per SDGs</h5>
                            <div class="chart-kategori-wrapper">
                                <div class="chart-container">
                                    <canvas id="kategoriChart"></canvas>
                                </div>
                                <div id="kategoriLegend" class="kategori-legend"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Tingkat Akhir --}}
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm p-3 h-100">
                            <h5 class="fw-bold mb-3" style="color:#6b1414;">Status Tingkat Akhir</h5>
                            <canvas id="statusChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- ====== SCRIPT CHART.JS ====== --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

        <!-- sidebar -->
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

        <script>
            const trendKolokium = @json($trendKolokium);
            const trendSeminar = @json($trendSeminar);
            const trendKompre = @json($trendKompre);

            const bulanLabel = [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ];
        </script>
        <script>
            const verifKolokium = @json([$kolokiumDisetujui, $kolokiumDitolak, $kolokiumPending]);
            const verifSeminar = @json([$seminarDisetujui, $seminarDitolak, $seminarPending]);
            const verifKompre = @json([$kompreDisetujui, $kompreDitolak, $komprePending]);
        </script>
        <script>
            const kategoriLabels = @json($sdgsNames);
            const kategoriColors = @json($sdgsColors);
            const kategoriCounts = @json($kategoriCount);
        </script>
        <script>
            const lulusKolokium = @json($lulusKolokium);
            const belumKolokium = @json($belumKolokium);

            const lulusSeminar = @json($lulusSeminar);
            const belumSeminar = @json($belumSeminar);

            const lulusKompre = @json($lulusKompre);
            const belumLulusKompre = @json($belumLulusKompre);
        </script>

        <script>
            Chart.register(ChartDataLabels);

            /* === Grafik Tren Pendaftar (Line Chart) === */
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: bulanLabel,
                    datasets: [{
                            label: 'Kolokium',
                            data: trendKolokium,
                            borderColor: '#e0a400',
                            tension: 0.4
                        },
                        {
                            label: 'Seminar',
                            data: trendSeminar,
                            borderColor: '#b44b4b',
                            tension: 0.4
                        },
                        {
                            label: 'Komprehensif',
                            data: trendKompre,
                            borderColor: '#6b1414',
                            tension: 0.4
                        }
                    ]
                }
            });

            /* === Donut Chart Verifikasi === */
            function donutChart(id, data) {
                return new Chart(document.getElementById(id), {
                    type: 'doughnut',
                    data: {
                        labels: ['Disetujui', 'Ditolak', 'Belum diverifikasi'],
                        datasets: [{
                            data: data,
                            backgroundColor: ['#013880', '#d9534f', '#bfbfbf'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            datalabels: {
                                color: '#333',
                                font: {
                                    weight: 'bold'
                                },
                                formatter: (value) => value > 0 ? value : ''
                            }
                        },
                        cutout: '70%'
                    }
                });
            }

            donutChart('verifKolokium', verifKolokium);
            donutChart('verifSeminar', verifSeminar);
            donutChart('verifKompre', verifKompre);

            // === Pie Chart Artikel per Kategori ===
            const kategoriChart = new Chart(document.getElementById('kategoriChart'), {
                type: 'pie',
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        label: 'Jumlah Artikel per SDGs',
                        data: kategoriCounts,
                        backgroundColor: kategoriColors, // ← pakai warna dari database
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: false
                        },
                        datalabels: {
                            color: '#333',
                            font: {
                                weight: 'bold'
                            },
                            formatter: (value) => value > 0 ? value : ''
                        }
                    }
                }
            });

            // === Legend manual ===
            const totalKategori = kategoriCounts.reduce((a, b) => a + b, 0);
            const legendDiv = document.getElementById('kategoriLegend');

            legendDiv.innerHTML = kategoriLabels.map((label, i) => {
                const percent = ((kategoriCounts[i] / totalKategori) * 100).toFixed(1);
                return `
          <div style="display:flex;align-items:center;margin-bottom:4px;">
              <span style="width:14px;height:14px;border-radius:3px;background:${kategoriColors[i]};margin-right:8px;"></span>
              <span>${label} — <strong>${percent}%</strong></span>
          </div>
      `;
            }).join('');



            /* === Bar Chart Status Tingkat Akhir === */
            const statusCtx = document.getElementById('statusChart').getContext('2d');

            new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: ['Kolokium', 'Seminar', 'Komprehensif'],
                    datasets: [{
                            label: 'Lulus',
                            data: [lulusKolokium, lulusSeminar, lulusKompre],
                            backgroundColor: '#013880'
                        },
                        {
                            label: 'Belum Lulus',
                            data: [belumKolokium, belumSeminar, belumLulusKompre],
                            backgroundColor: '#d9534f'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 1.6,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            color: '#000',
                            anchor: 'end',
                            align: 'top',
                            font: {
                                weight: 'bold'
                            },
                            formatter: value => value > 0 ? value : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10
                            }
                        },
                        x: {
                            barPercentage: 0.45,
                            categoryPercentage: 0.55
                        }
                    }
                }
            });
        </script>
    @endsection
