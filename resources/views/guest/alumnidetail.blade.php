@extends('layouts.app')

@section('content')
<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Alumni / Detail Alumni</span>
</div>

<!-- === DETAIL ALUMNI === -->
<section class="staff-det-section mb-5s">
  <div class="staff-det-container">
    <!-- FOTO ALUMNI -->
    <div class="staff-det-photo">
      <img src="{{ asset('img/buistie.jpg') }}" alt="Foto Alumni">
    </div>

    <!-- DETAIL ALUMNI -->
    <div class="staff-det-card">
      <h3 class="staff-det-name">Bagas Anggito</h3>
      <p class="staff-det-role">Manajer PT. XXXX</p>
      <p class="text-muted">DHH Angkatan 58</p>

      <div class="staff-det-info mt-3">
        <p style="text-align: justify;">
          Sebagai lulusan Departemen Hasil Hutan IPB, saya merasa sangat bersyukur pernah menempuh pendidikan di sini.
          Saat ini saya bekerja sebagai Sustainability Manager di salah satu perusahaan industri kayu besar di Indonesia,
          dan banyak sekali bekal yang saya dapat dari masa kuliah. DHH tidak hanya mengajarkan teori mengenai kayu, hutan,
          dan produk turunannya, tapi juga menanamkan cara berpikir sistematis, kritis, dan berorientasi solusi.
        </p>
        <p style="text-align: justify;">
          Selain itu, pengalaman mengikuti praktikum di lapangan dan proyek penelitian membuat saya terbiasa dengan tantangan dunia kerja nyata.
          Saya belajar bagaimana pentingnya inovasi dalam mengelola sumber daya hutan secara berkelanjutan,
          dan hal itu sangat relevan dengan pekerjaan saya sekarang. Saya bangga menjadi bagian dari keluarga besar DHH IPB—tempat yang tidak hanya membentuk profesional di bidang hasil hutan,
          tapi juga melahirkan generasi yang peduli terhadap keberlanjutan lingkungan.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- === ALUMNI LAINNYA === -->
 
<div class="judul-tengah">
  <h3 class="judul-tengah-title">Alumni Lainnya</h3>
  <img src="{{ asset('img/batasgold.png') }}" alt="divider" class="judul-tengah-divider">
</div>

<section class="guest-artikel-detail-section container my-5">

  <div class="guest-alumni-grid">
    <!-- Card 1 -->
    <div class="guest-alumni-card">
      <img src="{{ asset('img/buistie.jpg') }}" alt="Alumni 2">
      <h5>Dr. Mahdi Mubarok, S.Si., M.Si</h5>
      <p>
        Sebagai lulusan Departemen Hasil Hutan IPB, saya merasa sangat bersyukur pernah menempuh pendidikan di sini.
        Saat ini saya bekerja sebagai Sustainability Manager...
      </p>
      <a href="#" class="btn-see-more">Selengkapnya</a>
    </div>

    <!-- Card 2 -->
    <div class="guest-alumni-card">
      <img src="{{ asset('img/buistie.jpg') }}" alt="Alumni 3">
      <h5>Dr. Rina Dewi, M.Sc</h5>
      <p>
        Pengalaman belajar di DHH IPB telah membentuk saya menjadi pribadi yang mandiri dan profesional
        dalam menghadapi tantangan di industri hasil hutan...
      </p>
      <a href="#" class="btn-see-more">Selengkapnya</a>
    </div>

    <!-- Card 3 -->
    <div class="guest-alumni-card">
      <img src="{{ asset('img/buistie.jpg') }}" alt="Alumni 2">
      <h5>Dr. Mahdi Mubarok, S.Si., M.Si</h5>
      <p>
        Sebagai lulusan Departemen Hasil Hutan IPB, saya merasa sangat bersyukur pernah menempuh pendidikan di sini.
        Saat ini saya bekerja sebagai Sustainability Manager...
      </p>
      <a href="#" class="btn-see-more">Selengkapnya</a>
    </div>
  </div>
</section>
@endsection
