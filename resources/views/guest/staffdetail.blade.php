@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Departemen</span>
</div>

<!-- ======= Staff Detail Section ======= -->
<section class="staff-det-section">
  <div class="staff-det-container">

    <!-- Foto Staff -->
    <div class="staff-det-photo">
      <img src="{{ asset('img/padodi.jpg') }}" alt="Foto Staff">
    </div>

    <!-- Card Informasi Staff -->
    <div class="staff-det-card">
      <h4 class="staff-det-name">Prof. Dr. Ir. Dodi Nandika, MS</h4>
      <p class="staff-det-role">Guru Besar | Divisi Teknologi Peningkatan Mutu Kayu</p>

      <div class="staff-det-info">
        <div class="staff-det-row"><span>Tanggal Lahir</span><span>12 Mei 1980</span></div>
        <div class="staff-det-row"><span>Email</span><span>dodi@apps.ipb.ac.id</span></div>
        <div class="staff-det-row"><span>Sinta</span><span><a href="#">https://sinta.ristekbrin.go.id/authors/detail?id=5999596&view=overview</a></span></div>
        <div class="staff-det-row"><span>Google Scholar</span><span><a href="#">https://scholar.google.com/citations?hl=en&user=t4Q0JREAAAAJ</a></span></div>
        <div class="staff-det-row"><span>Scopus</span><span><a href="#">https://www.scopus.com/authid/detail.uri?authorId=47861323700</a></span></div>
        <div class="staff-det-row"><span>Website</span><span><a href="#">https://dodidi.com</a></span></div>
        <div class="staff-det-row"><span>ResearchGate</span><span><a href="#">https://www.researchgate.net/profile/Dodi-Nandika</a></span></div>
        <div class="staff-det-row"><span>Keahlian</span><span>Entomology & Wood Reservation</span></div>
      </div>


      <!-- Riwayat Pendidikan -->
      <div class="staff-det-section-sub">
        <h5>Riwayat Pendidikan</h5>
        <ul>
          <li>S1 - Institut Pertanian Bogor (2002)</li>
          <li>S2 - University of Goettingen, Germany (2007)</li>
          <li>S3 - Institut Pertanian Bogor (2011)</li>
        </ul>
      </div>

      <!-- Link Publikasi -->
      <div class="staff-det-section-sub">
        <h5>Publikasi</h5>
        <ul>
          <li><a href="#">Pengaruh Perlakuan Kimia terhadap Ketahanan Kayu Sengon</a></li>
          <li><a href="#">Analisis Biokomposit dari Serat Alam Lokal</a></li>
          <li><a href="#">Pemanfaatan Limbah Kayu dalam Industri Hijau</a></li>
        </ul>
      </div>
    </div>

  </div>
</section>

@endsection
