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
        <li><a href="/artikelguest">Artikel</a></li>
        <li><a href="/gallery">Gallery</a></li>
      </ul>
    </nav>

  </div>
</header>
