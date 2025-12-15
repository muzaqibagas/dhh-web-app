<!-- HEADER TOP (gold) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="header-top">
  <div class="container d-flex justify-content-between align-items-center text-white small">
    <div class="contact-info d-flex align-items-center gap-3">
      <span><i class="fas fa-envelope"></i> dhht@apps.ipb.ac.id</span>
      <span><i class="fas fa-phone"></i> (0251) 8621285</span>
    </div>
  </div>
</div>

<!-- MAIN NAVBAR -->
<header class="main-header">
  <div class="container d-flex justify-content-between align-items-center">
    
    <!-- LEFT LOGO -->
    <div class="logo header-logo">
        <img src="{{ asset('img/dhhputih.png') }}" alt="DHH Logo">
    </div>

    <!-- BURGER MENU (muncul cuma di layar kecil) -->
    <div class="burger-menu d-md-none">
      <i class="fas fa-bars"></i>
    </div>

    <!-- SIDEBAR NAV (versi mobile) -->
    <div class="mobile-sidebar" id="mobileSidebar">
      <div class="sidebar-header">
        <span class="close-btn">&times;</span>
        <img src="{{ asset('img/dhhputih.png') }}" alt="DHH Logo" class="sidebar-logo">
      </div>
      <ul class="sidebar-menu">
        <li><a href="{{ route('user.home') }}">Beranda</a></li>
        <li><a href="/sejarah">Departemen</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Pendidikan</a>
          <ul class="dropdown-menu">
            <li><a href="/pendidikans1">Sarjana/S1</a></li>
            <li><a href="/pendidikans2">Magister/S2</a></li>
            <li><a href="/pendidikans3">Doktor/S3</a></li>
          </ul>
        </li>
        <li><a href="/alumni">Alumni</a></li>
        <li><a href="/artikels">Artikel</a></li>
        <li><a href="/gallery">Galeri</a></li>
        <li><a href="/file">Layanan</a></li>
      </ul>
    </div>

    <!-- RIGHT MENU -->
    <nav class="navbar">
      <ul class="nav-menu d-flex">
        <li><a href="/home">Beranda</a></li>
        <li><a href="/sejarah">Departemen</a></li>
        
        <!-- Dropdown Pendidikan -->
        <li class="dropdown">
          <a href="#">Pendidikan ▾</a>
          <ul class="dropdown-menu">
            <li><a href="/pendidikans1">Sarjana/S1</a></li>
            <li><a href="/pendidikans2">Magister/S2</a></li>
            <li><a href="pendidikans3">Doktor/S3</a></li>
          </ul>
        </li>
        
        <li><a href="/alumni">Alumni</a></li>
        <li><a href="/artikels">Artikel</a></li>
        <li><a href="/gallery">Galeri</a></li>
        <li><a href="/file">Layanan</a></li>
      </ul>
    </nav>

  </div>
  <script>
  const burger = document.querySelector('.burger-menu');
  const sidebar = document.getElementById('mobileSidebar');
  const closeBtn = document.querySelector('.close-btn');
  const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

  burger.addEventListener('click', () => {
    sidebar.classList.add('active');
  });

  closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('active');
  });

  dropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', e => {
      e.preventDefault();
      toggle.parentElement.classList.toggle('active');
    });
  });
</script>

</header>
