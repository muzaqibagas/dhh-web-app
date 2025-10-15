@extends('layouts.app')

@section('content')
<body>
    <div class="guest-carousel-container">
        <!-- SLIDES -->
        <div class="guest-carousel-slide guest-active">
            <img src="img/slide1.png" alt="Slide 1">
            <div class="guest-carousel-caption">
                <h2>DEPARTEMEN HASIL HUTAN</h2>
                <p>Merupakan Departemen Hasil Hutan tertua di Indonesia dan memiliki fokus 
                  pada bidang keilmuan dan teknologi hasil hutan yang mencakup kimia hasil hutan, 
                  biokomposit, teknologi peningkatan kualitas kayu, dan desain dan keteknikan struktur kayu.</p>
            </div>
        </div>
        <div class="guest-carousel-slide">
            <img src="img/slide2.jpg" alt="Slide 2">
            <div class="guest-carousel-caption">
                <h2>Ilmu yang dipelajari</h2>
                <p>Pengembangan ilmu dan teknologi pemanfaatan hasil hutan untuk menghasilkan 
                  produk industri hasil hutan primer yang mencakup teknologi peningkatan kualitas kayu, 
                  kimia hasil hutan, biokomposit, desain dan keteknikan struktur kayu dan manajemen industri hasil hutan.</p>
            </div>
        </div>

        <!-- PANAH -->
        <button class="guest-carousel-prev">&#10094;</button>
        <button class="guest-carousel-next">&#10095;</button>
    </div>

        <script>
        const slides = document.querySelectorAll('.guest-carousel-slide');
        const prevBtn = document.querySelector('.guest-carousel-prev');
        const nextBtn = document.querySelector('.guest-carousel-next');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => slide.classList.toggle('guest-active', i === index));
        }

        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        // Auto slide tiap 5 detik
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 5000);
    </script>

    <!-- SHAPE MERAH MENUMPUK -->
    <!-- <div class="guest-carousel-overlay">
        <div class="guest-overlay-text">
            <h3>Innovation for Efficiency<br>and Sustainability</h3>
        </div>
        <div class="guest-overlay-icons">
            <div class="guest-icon-item">
                <img src="img/icon1.png" alt="Pendaftaran">
                <p>Pendaftaran</p>
            </div>
            <div class="guest-icon-item">
                <img src="img/icon2.png" alt="Program Studi">
                <p>Program Studi</p>
            </div>
            <div class="guest-icon-item">
                <img src="img/icon3.png" alt="Divisi">
                <p>Divisi</p>
            </div>
        </div>
    </div> -->
    <!-- ====== SECTION MENU KOTAK (RESPONSIF & BISA SLIDE) ====== -->
    <section class="guest-menu-section py-5">
      <div class="container position-relative">

        <!-- Panah kiri -->
        <button class="guest-menu-prev">
          <i class="bi bi-chevron-left"></i>
        </button>

        <!-- Panah kanan -->
        <button class="guest-menu-next">
          <i class="bi bi-chevron-right"></i>
        </button>

        <!-- Wrapper scroll -->
        <div class="guest-menu-wrapper">
          <div class="guest-menu-slide">
            <!-- Pendaftaran -->
            <a href="/pendaftaran" class="guest-menu-card">
              <img src="img/icon1.png" alt="Pendaftaran">
              <p>Pendaftaran</p>
            </a>
            <!-- Program Studi -->
            <a href="/program-studi" class="guest-menu-card">
              <img src="img/icon2.png" alt="Program Studi">
              <p>Program Studi</p>
            </a>
            <!-- Divisi -->
            <a href="/divisi" class="guest-menu-card">
              <img src="img/icon3.png" alt="Divisi">
              <p>Divisi</p>
            </a>
            <!-- Pendaftaran -->
            <a href="/layananakademik" class="guest-menu-card">
              <img src="img/icon4.png" alt="sistadhh">
              <p>SISTA DHH</p>
            </a>
          </div>
        </div>

      </div>
    </section>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const slide = document.querySelector(".guest-menu-slide");
      const cards = document.querySelectorAll(".guest-menu-card");
      const nextBtn = document.querySelector(".guest-menu-next");
      const prevBtn = document.querySelector(".guest-menu-prev");

      let index = 0;

      // Gandakan isi slide (buat efek loop tanpa jeda)
      slide.innerHTML += slide.innerHTML;
      const totalCards = slide.querySelectorAll(".guest-menu-card");
      const cardCount = cards.length;

      function updateSlide() {
        const cardWidth = totalCards[0].offsetWidth + 16; // lebar + gap
        slide.style.transform = `translateX(-${index * cardWidth}px)`;
      }

      nextBtn.addEventListener("click", () => {
        index++;
        updateSlide();

        // reset posisi biar mulus (loop tanpa kedip)
        if (index >= cardCount) {
          setTimeout(() => {
            slide.style.transition = "none";
            index = 0;
            updateSlide();
            void slide.offsetWidth; // reflow
            slide.style.transition = "transform 0.4s ease-in-out";
          }, 400);
        }
      });

      prevBtn.addEventListener("click", () => {
        index--;
        if (index < 0) {
          slide.style.transition = "none";
          index = cardCount - 1;
          updateSlide();
          void slide.offsetWidth; // reflow
          slide.style.transition = "transform 0.4s ease-in-out";
        }
        updateSlide();
      });

      window.addEventListener("resize", updateSlide);
    });
  </script>

<!-- <section class="guest-about-section"> -->
<section class="guest-galery-section">
  <div class="guest-about-container">
    <!-- KIRI: TEKS -->
    <div class="guest-about-text" data-aos="fade-up">
        <h3><span class="guest-highlight">Apa itu</span> <br>DEPARTEMEN HASIL HUTAN?</h3>
        <p>Departemen Hasil Hutan (DHH), Fakultas Kehutanan dan Lingkungan, Institut Pertanian Bogor
            merupakan pelopor pengembangan Ilmu Pengetahuan dan Teknologi Hasil Hutan di Indonesia.
            DHH telah terakreditasi sebagai Program Studi Unggul (nilai A) oleh Badan Akreditasi Nasional
            Perguruan Tinggi (BAN-PT).
        </p>
        <p>Pada tahun 2015, DHH juga telah terakreditasi internasional oleh Society of Wood Science
            and Technology (SWST). Bidang keilmuan dasar yang diterapkan meliputi Biologi, Fisika,
            Kimia, Keteknikan, Ekonomi dan Manajemen.
        </p>
        <p>Departemen Hasil Hutan terdiri atas
            <a href="#">Program Studi S1</a> (Teknologi Hasil Hutan),
            <a href="#">Program Studi S2</a> (Ilmu dan Teknologi Hasil Hutan), dan
            <a href="#">Program Studi S3</a> (Ilmu dan Teknologi Hasil Hutan).
        </p>
        <button class="guest-btn-about">Lihat Selengkapnya</button>
    </div>

    <!-- KANAN: FOTO -->
    <div class="guest-about-image" data-aos="fade-up">
        <img src="img/foto-dhh.png" alt="Mahasiswa DHH">
    </div>
  </div>
</section>

    <script>
        AOS.init({
            duration: 1000,  /* animasi 1 detik */
            once: true       /* hanya sekali muncul */
        });
    </script>

<!-- Artikel -->

<section class="guest-galery-section">
  
<h3 class="guest-pend-section-title">Artikel</h3>
<img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
  <div class="guest-blog-grid">
    <!-- Featured (besar) -->
    <div class="guest-blog-card guest-featured">
        <div class="guest-blog-image">
            <img src="https://picsum.photos/800/500?random=1" alt="Blog Featured">
            <div class="guest-overlay">
                <div class="guest-meta">
                    <span>Apr. 14th, 2025</span> | <span>Technology</span>
                </div>
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>
            </div>
        </div>
    </div>

    <!-- Card biasa -->
    <div class="guest-blog-card guest-side">
        <div class="guest-blog-image">
            <img src="https://picsum.photos/600/500?random=2" alt="Blog 2">
            <div class="guest-overlay">
                <div class="guest-meta">
                    <span>Apr. 14th, 2025</span> | <span>Security</span>
                </div>
                <h3>Sed do eiusmod tempor incididunt ut labore</h3>
            </div>
        </div>
    </div>

    <div class="guest-blog-card">
        <div class="guest-blog-image">
            <img src="https://picsum.photos/600/400?random=3" alt="Blog 3">
            <div class="guest-overlay">
                <div class="guest-meta">
                    <span>Apr. 14th, 2025</span> | <span>Career</span>
                </div>
                <h3>Ut enim ad minim veniam, quis nostrud exercitation</h3>
            </div>
        </div>
    </div>

    <div class="guest-blog-card">
        <div class="guest-blog-image">
            <img src="https://picsum.photos/600/400?random=4" alt="Blog 4">
            <div class="guest-overlay">
                <div class="guest-meta">
                    <span>Apr. 14th, 2025</span> | <span>Cloud</span>
                </div>
                <h3>Adipiscing elit, sed do eiusmod tempor incididunt</h3>
            </div>
        </div>
    </div>

    <div class="guest-blog-card">
        <div class="guest-blog-image">
            <img src="https://picsum.photos/600/400?random=5" alt="Blog 5">
            <div class="guest-overlay">
                <div class="guest-meta">
                    <span>Apr. 14th, 2025</span> | <span>Programming</span>
                </div>
                <h3>Excepteur sint occaecat cupidatat non proident</h3>
            </div>
        </div>
    </div>
  </div>
</section>

<!-- Gallery -->
<section class="guest-galery-section">
  <h3 class="guest-pend-section-title">Gallery</h3>
  <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">

    <!-- Grid Foto -->
    <div class="guest-galery-grid guest-galery-grid-5">
      <div class="guest-galery-item" data-category="akademik">
          <img src="img/bglogin.jpg" alt="Akademik">
      </div>
      <div class="guest-galery-item" data-category="sdgs">
          <img src="img/bglogin.jpg" alt="SDGS">
      </div>
      <div class="guest-galery-item" data-category="prestasi">
          <img src="img/bglogin.jpg" alt="Prestasi">
      </div>
      <div class="guest-galery-item" data-category="fasilitas">
          <img src="img/bglogin.jpg" alt="Fasilitas">
      </div>
      <div class="guest-galery-item" data-category="kegiatan">
          <img src="img/bglogin.jpg" alt="Kegiatan">
      </div>
      <div class="guest-galery-item" data-category="akademik">
          <img src="img/bglogin.jpg" alt="Akademik">
      </div>
          <div class="guest-galery-item" data-category="kegiatan">
          <img src="img/bglogin.jpg" alt="Kegiatan">
      </div>
          <div class="guest-galery-item" data-category="kegiatan">
          <img src="img/bglogin.jpg" alt="Kegiatan">
      </div>
      <div class="guest-galery-item" data-category="akademik">
          <img src="img/bglogin.jpg" alt="Akademik">
      </div>
          <div class="guest-galery-item" data-category="kegiatan">
          <img src="img/bglogin.jpg" alt="Kegiatan">
      </div>
      
      <!-- Tombol Lihat Selengkapnya -->
      <div class="d-flex justify-content-end mt-3">
        <a href="/gallery" class="btn-see-more">Lihat Selengkapnya →</a>
      </div>
    </div>
</section>


<!-- Alumni Testimonial Section -->

<section class="guest-galery-section">
      <h3 class="guest-pend-section-title">Apa Kata Alumni?</h3>
      <img src="img/batasgold.png" class="guest-pend-divider" alt="divider">
      
    <div id="guestAlumniCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Carousel Indicators -->
      <div class="carousel-indicators mb-4">
        <button type="button" data-bs-target="#guestAlumniCarousel" data-bs-slide-to="0"
          class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#guestAlumniCarousel" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#guestAlumniCarousel" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">

        <!-- Testimonial 1 -->
        <div class="carousel-item active">
          <div class="p-4 guest-rounded-8 text-white bg-opacity-75"
            style="background: url('img/bgalumni.jpg') center center / cover no-repeat;">
            <div class="row align-items-center">

              <!-- Gambar alumni -->
              <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="img/buratih.jpg" alt="alumni"
                  class="guest-alumni-img rounded-circle img-fluid shadow">
              </div>

              <!-- Teks -->
              <div class="col-md-9">
                <h5 class="fw-bold mb-1">Ratih Damayanti, S.Hut.M.Si.Ph.D</h5>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Peneliti pada Kementerian Lingkungan Hidup dan Kehutanan; Koordinator National
                  Focal Point of ASEAN Working Group for Forest Products Development (AWG FPD);
                  dan International Association of Wood Anatomist (IAWA) Council; 10 besar tingkat
                  Nasional Anugerah ASN 2019. “Awalnya memilih Fakultas Kehutanan IPB karena selama SMA, saya aktif di
                  organisasi pecinta alam. Saya masuk melalui jalur PMDK, dan memilih jurusan
                  Teknologi Hasil Hutan karena melihat itu nama jurusan yang paling keren dan
                  canggih, ada kata teknologinya 😊
                </p>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Setelah masuk, saya semakin merasa beruntung, karena di THH saya menemukan diri
                  saya. Dosen pengajarnya asyik dan selalu memotivasi membuat saya terus terpacu
                  untuk mencari ilmu dan belajar. Saat memasuki dunia kerja, bekal yang diberikan pada pendidik membuat saya
                  percaya diri, dan membuktikan bahwa lulusan THH IPB bisa berada di depan.
                  Belajar di THH IPB tidak hanya identik dengan bekerja di lab mengutak-atik kayu,
                  tapi ilmunya sangat luas dari hulu ke hilir, sehingga lulusan THH IPB bisa
                  berkiprah dan memberikan manfaat di berbagai bidang. "<strong>DTHH IPB, teruslah
                    berkibar!!!</strong>”
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="carousel-item">
          <div class="p-4 guest-rounded-8 text-white bg-opacity-75"
            style="background: url('img/bgalumni.jpg') center center / cover no-repeat;">
            <div class="row align-items-center">
              <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="img/buratih.jpg" alt="alumni"
                  class="guest-alumni-img rounded-3 img-fluid shadow">
              </div>
              <!-- Teks -->
              <div class="col-md-9">
                <h5 class="fw-bold mb-1">Ratih Damayanti, S.Hut.M.Si.Ph.D</h5>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Peneliti pada Kementerian Lingkungan Hidup dan Kehutanan; Koordinator National
                  Focal Point of ASEAN Working Group for Forest Products Development (AWG FPD);
                  dan International Association of Wood Anatomist (IAWA) Council; 10 besar tingkat
                  Nasional Anugerah ASN 2019. “Awalnya memilih Fakultas Kehutanan IPB karena selama SMA, saya aktif di
                  organisasi pecinta alam. Saya masuk melalui jalur PMDK, dan memilih jurusan
                  Teknologi Hasil Hutan karena melihat itu nama jurusan yang paling keren dan
                  canggih, ada kata teknologinya 😊
                </p>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Setelah masuk, saya semakin merasa beruntung, karena di THH saya menemukan diri
                  saya. Dosen pengajarnya asyik dan selalu memotivasi membuat saya terus terpacu
                  untuk mencari ilmu dan belajar. Saat memasuki dunia kerja, bekal yang diberikan pada pendidik membuat saya
                  percaya diri, dan membuktikan bahwa lulusan THH IPB bisa berada di depan.
                  Belajar di THH IPB tidak hanya identik dengan bekerja di lab mengutak-atik kayu,
                  tapi ilmunya sangat luas dari hulu ke hilir, sehingga lulusan THH IPB bisa
                  berkiprah dan memberikan manfaat di berbagai bidang. "<strong>DTHH IPB, teruslah
                    berkibar!!!</strong>”
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="carousel-item">
          <div class="p-4 guest-rounded-8 text-white bg-opacity-55"
            style="background: url('img/bgalumni.jpg') center center / cover no-repeat;">
            <div class="row align-items-center">
              <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="img/buratih.jpg" alt="alumni"
                  class="guest-alumni-img rounded-3 img-fluid shadow">
              </div>
              <!-- Teks -->
              <div class="col-md-9">
                <h5 class="fw-bold mb-1">Ratih Damayanti, S.Hut.M.Si.Ph.D</h5>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Peneliti pada Kementerian Lingkungan Hidup dan Kehutanan; Koordinator National
                  Focal Point of ASEAN Working Group for Forest Products Development (AWG FPD);
                  dan International Association of Wood Anatomist (IAWA) Council; 10 besar tingkat
                  Nasional Anugerah ASN 2019. “Awalnya memilih Fakultas Kehutanan IPB karena selama SMA, saya aktif di
                  organisasi pecinta alam. Saya masuk melalui jalur PMDK, dan memilih jurusan
                  Teknologi Hasil Hutan karena melihat itu nama jurusan yang paling keren dan
                  canggih, ada kata teknologinya 😊
                </p>
                <p class="text-white-50 small fst-italic mb-3 text-justify">
                  Setelah masuk, saya semakin merasa beruntung, karena di THH saya menemukan diri
                  saya. Dosen pengajarnya asyik dan selalu memotivasi membuat saya terus terpacu
                  untuk mencari ilmu dan belajar. Saat memasuki dunia kerja, bekal yang diberikan pada pendidik membuat saya
                  percaya diri, dan membuktikan bahwa lulusan THH IPB bisa berada di depan.
                  Belajar di THH IPB tidak hanya identik dengan bekerja di lab mengutak-atik kayu,
                  tapi ilmunya sangat luas dari hulu ke hilir, sehingga lulusan THH IPB bisa
                  berkiprah dan memberikan manfaat di berbagai bidang. "<strong>DTHH IPB, teruslah
                    berkibar!!!</strong>”
                </p>
              </div>
            </div>
          </div>
        </div>

      </div> <!-- end carousel-inner -->
    </div> <!-- end guestAlumniCarousel -->
  </div>
</section>

  </div>
</section>

<!-- Program Studi Accordion -->
<section class="guest-prodi-section">
  <div class="guest-prodi-container container">
    <div class="row align-items-center">
      <!-- Kiri -->
      <div class="col-md-4 text-white">
        <h6 class="text-warning fw-bold">Program Studi</h6>
        <h2 class="fw-bold">Departemen<br>Hasil Hutan</h2>
      </div>
      <div class="col-md-8">
        <div class="accordion guest-accordion" id="guestAccordion">

          <!-- S1 -->
          <div class="accordion-item guest-accordion-item mb-3">
            <h2 class="accordion-header" id="guestHeadingOne">
              <button class="accordion-button guest-accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#guestCollapseOne" aria-expanded="false"
                aria-controls="guestCollapseOne">
                Program Studi S1 : Teknologi Hasil Hutan
              </button>
            </h2>
            <div id="guestCollapseOne" class="accordion-collapse collapse"
              aria-labelledby="guestHeadingOne" data-bs-parent="#guestAccordion">
              <div class="accordion-body guest-accordion-body">
                Program Studi Teknologi Hasil Hutan merupakan salah satu program studi yang ada di
                Departemen Hasil Hutan Fakultas Kehutanan dan Lingkungan IPB. Program Studi Teknologi Hasil Hutan memperoleh
                akreditasi A berdasarkan keputusan dari Badan Akreditasi Nasional - Perguruan Tinggi (BAN-PT) No.
                0140/SK/BAN-PT/Akred/S/I/2017 tanggal 10 Januari 2017 dan berlaku sampai tanggal 10 Januari 2022.
              </div>
            </div>
          </div>

          <!-- S2 -->
          <div class="accordion-item guest-accordion-item mb-3">
            <h2 class="accordion-header" id="guestHeadingTwo">
              <button class="accordion-button guest-accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#guestCollapseTwo" aria-expanded="false"
                aria-controls="guestCollapseTwo">
                Program Studi S2 : Ilmu dan Teknologi Hasil Hutan
              </button>
            </h2>
            <div id="guestCollapseTwo" class="accordion-collapse collapse"
              aria-labelledby="guestHeadingTwo" data-bs-parent="#guestAccordion">
              <div class="accordion-body guest-accordion-body">
                Program Studi S2 Ilmu dan Teknologi Hasil Hutan (PS THH) diselenggarakan oleh Departemen
                Hasil Hutan (DHH) IPB dengan sistem kurikulum Mayor-Minor, yang mulai diterapkan sejak tahun ajaran 2007/2008.
              </div>
            </div>
          </div>

          <!-- S3 -->
          <div class="accordion-item guest-accordion-item mb-3">
            <h2 class="accordion-header" id="guestHeadingThree">
              <button class="accordion-button guest-accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#guestCollapseThree" aria-expanded="false"
                aria-controls="guestCollapseThree">
                Program Studi S3 : Ilmu dan Teknologi Hasil Hutan
              </button>
            </h2>
            <div id="guestCollapseThree" class="accordion-collapse collapse"
              aria-labelledby="guestHeadingThree" data-bs-parent="#guestAccordion">
              <div class="accordion-body guest-accordion-body">
                Program Studi S3 Rekayasa dan Peningkatan Mutu Hasil Hutan (S3 RPM) dikelola oleh
                Departemen Hasil Hutan (DHH) IPB dengan sistem kurikulum Mayor-Minor yang berlaku sejak tahun ajaran 2007/2008.
              </div>
            </div>
          </div>

        </div> <!-- end accordion -->
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="guestContact" class="guest-contact section">
  <div class="container guest-section-title" data-aos="fade-up">
    <h2>Terhubung Dengan Kami</h2>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 mb-5">
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="guest-contact-box">
          <div class="icon-box"><i class="bi bi-geo-alt"></i></div>
          <div class="info-content">
            <h4>Alamat Kami</h4>
            <p>Departemen Hasil Hutan, Jl. Ulin, Babakan, kec. Dramaga, Kabupaten Bogor, Jawa Barat 16680</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="guest-contact-box">
          <div class="icon-box"><i class="bi bi-envelope"></i></div>
          <div class="info-content">
            <h4>Kontak Kami</h4>
            <p>Email : dhht@apps.ipb.ac.id</p>
            <p>Telepon/Fax : 0251-8621285</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="guest-contact-box">
          <div class="icon-box"><i class="bi bi-headset"></i></div>
          <div class="info-content">
            <h4>Jam Operasional</h4>
            <p>Senin - Kamis : 08.00 WIB - 16.00 WIB</p>
            <p>Jum'at : 08.00 WIB - 16.30 WIB</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Maps -->
  <div class="guest-map-container">
    <div class="row">
      <div class="guest-map-section" data-aos="fade-up" data-aos-delay="200">
        <iframe src="https://maps.google.com/maps?q=Departemen%20Hasil%20Hutan%20&t=m&z=13&output=embed&iwloc=near"
          width="100%" height="500" style="border:0;" allowfullscreen loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

                </div>
            </div>
        </div>
    </section>
</body>
</html>

@endsection
