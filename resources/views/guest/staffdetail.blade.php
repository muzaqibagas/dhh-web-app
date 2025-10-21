@extends('layouts.app')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>
<!-- ======= Staff Detail Section ======= -->
<section class="staff-det-section container">
  <div class="staff-det-container">

    <!-- Foto -->
    <div class="staff-det-photo">
      <img src="{{ asset('img/dodi.jpg') }}" alt="Foto Staff">
    </div>

    <!-- Card Flip -->
    <div class="staff-det-card" id="staffCard">
      <div class="staff-det-card-inner">

        <!-- Sisi Depan -->
        <div class="staff-det-card-front">
          <h5>Prof. Dr. Ir. Dodi Nandika, MS</h5>
          <p><strong>Guru Besar</strong></p>
          <p>Divisi Teknologi Peningkatan Mutu Kayu</p>
          <ul>
            <li><b>Tanggal Lahir:</b> 18 Juni 1980</li>
            <li><b>Email:</b> dodi@gmail.com</li>
            <li><b>Sinta:</b> www.sinta.com</li>
            <li><b>Google Scholar:</b> www.scdodi.com</li>
            <li><b>Scopus:</b> www.scopus.com</li>
            <li><b>Website:</b> www.dodiweb.com</li>
          </ul>

          <!-- Tombol Panah -->
          <button class="staff-det-flip-btn" onclick="flipCard()">
            <i class="fas fa-rotate-forward"></i>
          </button>
        </div>

        <!-- Sisi Belakang -->
        <div class="staff-det-card-back">
          <h5>Informasi Lanjutan</h5>
          <ul>
            <li><b>Research Gate:</b> www.rgdodi.com</li>
            <li><b>Keahlian:</b> Entomology & Wood Reservation</li>
            <li><b>Publikasi:</b> www.publikasi1.com, www.publikasi2.com</li>
            <li><b>Riwayat Pendidikan:</b>
              <ul>
                <li>S1: Institut Pertanian Bogor</li>
                <li>S2: University of Gottingen, Germany</li>
                <li>S3: Institut Pertanian Bogor</li>
              </ul>
            </li>
          </ul>

          <!-- Tombol Kembali -->
          <button class="staff-det-flip-btn" onclick="flipCard()">
            <i class="fas fa-rotate-back"></i>
          </button>
        </div>
      </div>
    </div>
    
    <script>
        function flipCard() {
            document.querySelector(".staff-det-card").classList.toggle("flipped");
        }
    </script>

  </div>
</section>
