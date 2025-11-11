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
      $isStaffDeptActive = Request::is('kategoristaff') || Request::is('staff-dept') || Request::is('ketuadhh');
      $isTingkatAkhirActive = Request::is('undangan') || Request::is('kolokium') || Request::is('seminar') || Request::is('sidang');
      $isKontenActive = Request::is('kategorigaleri') || Request::is('galeri') || Request::is('kategoriartikel') || Request::is('artikel') || Request::is('review-alumni') || Request::is('konten-dept') || Request::is('kontenjenjang') || Request::is('mitra');
      $isAdminProfileActive = Request::is('admprofile') || Request::is('user/*/edit') || Request::is('editpassadm') || Request::is('logoutadmprofile');
      @endphp

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
      <a href="/undangan"
        class="submenu-link {{ Request::is('undangan') ? 'active-submenu' : '' }}">
        <i class="bi bi-envelope-open"></i> Undangan
      </a>
      <a href="/kolokium"
        class="submenu-link {{ Request::is('kolokium') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Data Pendaftar Kolokium
      </a>
      <a href="/seminar"
        class="submenu-link {{ Request::is('seminar') ? 'active-submenu' : '' }}">
        <i class="bi bi-calendar-event"></i> Data Pendaftar Seminar
      </a>
      <a href="/sidang"
        class="submenu-link {{ Request::is('sidang') ? 'active-submenu' : '' }}">
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
        class="submenu-link {{ Request::is('kategorigaleri') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Galeri
      </a>
      <a href="/galeri"
        class="submenu-link {{ Request::is('galeri') ? 'active-submenu' : '' }}">
        <i class="bi bi-images"></i> Galeri
      </a>
      <a href="/kategoriartikel"
        class="submenu-link {{ Request::is('kategoriartikel') ? 'active-submenu' : '' }}">
        <i class="bi bi-clipboard-check"></i> Kategori Artikel
      </a>
      <a href="/artikel"
        class="submenu-link {{ Request::is('artikel') ? 'active-submenu' : '' }}">
        <i class="bi bi-layout-text-window"></i> Artikel
      </a>
      <a href="/review-alumni"
        class="submenu-link {{ Request::is('review-alumni') ? 'active-submenu' : '' }}">
        <i class="bi bi-star"></i>  Review Alumni
      </a>
      <a href="/konten-dept"
        class="submenu-link {{ Request::is('konten-dept') ? 'active-submenu' : '' }}">
        <i class="bi bi-laptop"></i> Konten Departemen
      </a>
      <a href="/kontenjenjang"
        class="submenu-link {{ Request::is('kontenjenjang') ? 'active-submenu' : '' }}">
        <i class="bi bi-house-door"></i> Konten Jenjang
      </a>
      <a href="/mitra"
        class="submenu-link {{ Request::is('mitra') ? 'active-submenu' : '' }}">
        <i class="bi bi-person-check"></i> Mitra
      </a>
    </div>

    <!-- BTN SDM ===================== -->
    <a href="#" class="menu {{ $isStaffDeptActive ? 'active' : '' }}" data-dropdown="staff-dept">
      <div class="menu-left">
        <i class="bi bi-people-fill"></i>
        <span> Sumber Daya Manusia </span>
      </div>
      <span class="dropdownArrow" data-arrow="staff-dept">
        {!! $isStaffDeptActive ? '&#9660;' : '&#9650;' !!}
      </span>
    </a>
    <div data-menu="staff-dept"
      style="margin-left:24px; flex-direction:column; {{ $isStaffDeptActive ? 'display:flex;' : 'display:none;' }}">
      <a href="/kategoristaff"
        class="submenu-link {{ Request::is('kategoristaff') ? 'active-submenu' : '' }}">
        <i class="bi bi-envelope-open"></i> Kategori Staff Departemen
      </a>
      <a href="/staff-dept"
        class="submenu-link {{ Request::is('staff-dept') ? 'active-submenu' : '' }}">
        <i class="bi bi-check2-circle"></i> Staff Departemen
      </a>
      <a href="/ketuadhh"
        class="submenu-link {{ Request::is('ketuadhh') ? 'active-submenu' : '' }}">
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
      <a href="/editpassadm"
        class="submenu-link {{ Request::is('editpassadm') ? 'active-submenu' : '' }}">
        <i class="bi bi-gear-wide-connected"></i> Edit Password
      </a>
      <form action="{{ route('login.logout') }}" method="POST" class="menu p-0 m-0">
        @csrf
        <button type="submit" class="menu w-100 text-start border-0 bg-transparent">
          <div class="menu-left">
            <i class="bi bi-box-arrow-right"></i> <span> Keluar Akun </span>
          </div>
        </button>
      </form>   
    </div>
      <!-- <a href="#" class="menu logout"><i class="bi bi-box-arrow-right"></i> Keluar Akun</a> -->
    
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
  </aside>

<main class="content px-4 py-4">
  <h2 class="text-center fw-bold mb-4" style="color:#6b1414;">Dashboard Admin</h2>

  {{-- === DATA PENDAFTAR === --}}
  <div class="row g-3 mb-4">
    @foreach([
      ['title' => 'Kolokium', 'jumlah' => 17],
      ['title' => 'Seminar', 'jumlah' => 34],
      ['title' => 'Komprehensif', 'jumlah' => 243]
    ] as $item)
      <div class="col-12 col-md-4">
        <div class="data-card shadow-sm border-0 text-center">
          <h5 class="fw-bold" style="color:#6b1414;">{{ $item['title'] }}</h5>
          <h2 class="fw-bold mb-0" style="color:#6b1414;">{{ $item['jumlah'] }}</h2>
          <p class="text-secondary mb-0">Mahasiswa</p>
        </div>
      </div>
    @endforeach
  </div>

  {{-- === GRID CHARTS === --}}
  <div class="row g-4">
    
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
            <span style="display:inline-block;width:14px;height:14px;background:#013880;border-radius:3px;margin-right:5px;"></span>
            Disetujui
          </div>
          <div class="d-inline-block mx-2">
            <span style="display:inline-block;width:14px;height:14px;background:#d9534f;border-radius:3px;margin-right:5px;"></span>
            Ditolak
          </div>
          <div class="d-inline-block mx-2">
            <span style="display:inline-block;width:14px;height:14px;background:#bfbfbf;border-radius:3px;margin-right:5px;"></span>
            Belum diverifikasi
          </div>
        </div>
      </div>
    </div>

    {{-- Artikel per Kategori --}}
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm p-3 h-100">
        <h5 class="fw-bold mb-3" style="color:#6b1414;">Artikel per Kategori</h5>
        <div class="d-flex justify-content-center align-items-center flex-wrap flex-lg-nowrap">
          <div class="me-lg-4">
            <canvas id="kategoriChart" style="width:260px;height:260px;"></canvas>
          </div>
          <div id="kategoriLegend" class="text-start mt-3 mt-lg-0"></div>
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
</main>

{{-- ====== SCRIPT CHART.JS ====== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
Chart.register(ChartDataLabels);

/* === Grafik Tren Pendaftar (Line Chart) === */
new Chart(document.getElementById('trendChart'), {
  type: 'line',
  data: {
    labels: ['Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November'],
    datasets: [
      { label: 'Kolokium', data: [100, 60, 40, 80, 90, 70], borderColor: '#6b1414', tension: 0.3 },
      { label: 'Seminar', data: [40, 70, 80, 120, 100, 110], borderColor: '#b44b4b', tension: 0.3 },
      { label: 'Komprehensif', data: [60, 80, 90, 60, 70, 120], borderColor: '#e0a400', tension: 0.3 },
    ]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: true, position: 'bottom' } },
    scales: { y: { beginAtZero: true } }
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
      plugins: { legend: { display: false } },
      cutout: '70%'
    }
  });
}
donutChart('verifKolokium', [70, 20, 10]);
donutChart('verifSeminar', [60, 30, 10]);
donutChart('verifKompre', [80, 10, 10]);

/* === Pie Chart Artikel per Kategori (dengan label persentase) === */
const kategoriData = [55, 75, 12, 45, 23];
const kategoriLabels = ['Prestasi', 'Akademik', 'Berita', 'Karir', 'SDGS'];
const kategoriColors = ['#f39c12', '#2980b9', '#9b59b6', '#e74c3c', '#27ae60'];

const kategoriChart = new Chart(document.getElementById('kategoriChart'), {
  type: 'pie',
  data: {
    labels: kategoriLabels,
    datasets: [{
      data: kategoriData,
      backgroundColor: kategoriColors
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
      datalabels: {
        color: '#fff',
        font: { weight: 'bold' },
        formatter: (value, ctx) => {
          const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
          const percentage = ((value / total) * 100).toFixed(1) + '%';
          return percentage;
        }
      }
    }
  }
});

// Buat legend manual biar bisa ada kategori + warna + persentase
// Buat legend di kanan pie chart
const totalKategori = kategoriData.reduce((a, b) => a + b, 0);
const legendDiv = document.getElementById('kategoriLegend');
legendDiv.innerHTML = kategoriLabels.map((label, i) => {
  const percent = ((kategoriData[i] / totalKategori) * 100).toFixed(1);
  return `
    <div style="display:flex;align-items:center;margin-bottom:6px;">
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
    datasets: [
      { label: 'Lulus', data: [90, 70, 110], backgroundColor: '#013880' },
      { label: 'Belum Lulus', data: [40, 50, 60], backgroundColor: '#d9534f' }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: true, // ✅ biar proporsional (tidak kepanjangan)
    aspectRatio: 1.6,          // ✅ atur perbandingan lebar : tinggi chart
    plugins: { legend: { position: 'bottom' } },
    scales: {
      y: {
        beginAtZero: true,
        max: 120,
        ticks: { stepSize: 20 }
      },
      x: {
        barPercentage: 0.4,     // ✅ atur lebar batang
        categoryPercentage: 0.5 // ✅ kasih jarak antar grup
      }
    }
  }
});

</script>
@endsection
