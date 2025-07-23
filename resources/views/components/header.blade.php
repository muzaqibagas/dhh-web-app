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
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Departemen</a></li>
        
        <!-- Dropdown Pendidikan -->
        <li class="dropdown">
          <a href="#">Pendidikan ▾</a>
          <ul class="dropdown-menu">
            <li><a href="#">Sarjana</a></li>
            <li><a href="#">Magister</a></li>
            <li><a href="#">Doktor</a></li>
          </ul>
        </li>
        
        <li><a href="#">Alumni</a></li>
        <li><a href="#">Artikel</a></li>
        <li><a href="#">Gallery</a></li>
      </ul>
    </nav>

  </div>
</header>
