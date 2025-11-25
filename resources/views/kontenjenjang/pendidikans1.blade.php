@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Pendidikan S1</span>
</div>
@if (!$data)
<div class="text-center my-5">
    <i class="bi bi-info-circle" style="font-size: 3rem;"></i>
    <h4 class="mt-3">Page isn't available right now</h4>
    <p>Konten belum tersedia.</p>
</div>
@else
  <!-- === Profil Program Studi === -->
  @if(!empty(trim($data->profil ?? '')))
  <section class="pend-section mt-5">
    <div class="pend-container" data-aos="fade-up">    
      <div class="pend-text">
        <h3>Profil Program Studi S1</h3>
        <img src="{{ asset('img/batasgold.png') }}" alt="divider">
        @php
            $text = $data->profil ?? '-';
            $lines = preg_split('/\r\n|\r|\n/', trim($text));
            $insideList = false;
        @endphp

        @if(!empty(trim($text)))
        <div style="text-align: justify;">
            @foreach ($lines as $line)
                @php
                    $isNumbered = preg_match('/^\s*\d+\./', $line);
                @endphp
                
                @if ($isNumbered)
                    {{-- Jika belum dalam <ol>, buka <ol> --}}
                    @if (!$insideList)
                        <ol style="padding-left: 20px; margin-left: 10px;">
                        @php $insideList = true; @endphp
                    @endif

                    <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

                @else                    
                    @if ($insideList)
                        </ol>
                        @php $insideList = false; @endphp
                    @endif

                    {{-- Tampilkan paragraf biasa --}}
                    @if (trim($line) !== '')
                        <p style="margin-top: 10px;">{{ $line }}</p>
                    @endif
                @endif
            @endforeach
            
            @if ($insideList)
                </ol>
            @endif
        </div>
        @endif
      </div>

      <!-- Foto -->
      @if (!empty($data->foto))
      <div class="pend-image">
          <img src="{{ asset($data->foto) }}" alt="Foto Program">
      </div>
      @endif
    </div>
  </section>
  @endif

  <!-- === Visi === -->
  @if(!empty(trim($data->visi ?? '')))
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Visi</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    @php
        $text = $data->visi ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    <div style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>
  </section>
  @endif

  <!-- === Misi === -->
  @if(!empty(trim($data->misi ?? '')))
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Misi</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    @php
        $text = $data->misi ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    <div style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>
  </section>
  @endif

  <!-- === Tujuan Pendidikan === -->
  @if(!empty(trim($data->tujuanpendidikan ?? '')))
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Tujuan Pendidikan</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    @php
        $text = $data->tujuanpendidikan ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    <div style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>
  </section>
  @endif

  <!-- === Kompetensi Lulusan === -->
  @if(!empty(trim($data->kompetensilulusan ?? '')))
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Kompetensi Lulusan</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    @php
        $text = $data->kompetensilulusan ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    <div style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>
  </section>
  @endif

  <!-- === Capaian Pembelajaran === -->
  @if(!empty(trim($data->capaianpembelajaran ?? '')))
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Capaian Pembelajaran</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    @php
        $text = $data->capaianpembelajaran ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    <div style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>  
  </section>
  @endif

  <!-- Leaflet (Flayer) -->
  @if(!empty($data->leaflets) && $data->leaflets->count() > 0)
  <section class="pend-section" data-aos="fade-up">  
    <div class="pend-flayer d-flex gap-3 mt-4">
      @foreach($data->leaflets as $leaf)
        <div class="col-md-6 mb-3">
            <img src="{{ asset($leaf->gambar) }}" class="img-fluid rounded shadow-sm">
        </div>
      @endforeach     
    </div>
  </section>
  @endif

  <!-- === Kurikulum === -->
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Kurikulum dan Mata Kuliah</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <p style="text-align: justify;">
      Silakan kunjungi laman 
      <a href="https://panduan.ipb.ac.id" target="_blank">panduan.ipb.ac.id</a>
      untuk melihat informasi lengkap mengenai mata kuliah dan kurikulum.
    </p>    

  </section>

  <!-- === Akreditasi Nasional === -->
  @if(!empty(trim($data->deskripsiakreditasi ?? '')))  
  <section class="pend-section" data-aos="fade-up">
    <div class="pend-text">
      <h3>Akreditasi Nasional</h3>
      <img src="{{ asset('img/batasgold.png') }}" alt="divider">
    </div>
    <!-- === Sertifikat Akreditasi Nasional === -->
    @if (!empty($data->sertifikatakreditasi))    
    <div class="text-center">    
      <img src="{{ asset($data->sertifikatakreditasi) }}" alt="Sertifikat Akreditasi" class="img-fluid rounded shadow-sm my-3" style="max-width: 400px;">
    </div>
    @endif
    <!-- === Deskripsi Akreditasi Nasional === -->  
    @php
        $text = $data->deskripsiakreditasi ?? '-';
        $lines = preg_split('/\r\n|\r|\n/', trim($text));
        $insideList = false;
    @endphp

    @if(!empty(trim($text)))
    <div class="text-center" style="text-align: justify;">
        @foreach ($lines as $line)
            @php
                $isNumbered = preg_match('/^\s*\d+\./', $line);
            @endphp
            
            @if ($isNumbered)
                {{-- Jika belum dalam <ol>, buka <ol> --}}
                @if (!$insideList)
                    <ol style="padding-left: 20px; margin-left: 10px;">
                    @php $insideList = true; @endphp
                @endif

                <li>{{ preg_replace('/^\s*\d+\.\s*/', '', $line) }}</li>

            @else                    
                @if ($insideList)
                    </ol>
                    @php $insideList = false; @endphp
                @endif

                {{-- Tampilkan paragraf biasa --}}
                @if (trim($line) !== '')
                    <p style="margin-top: 10px;">{{ $line }}</p>
                @endif
            @endif
        @endforeach
        
        @if ($insideList)
            </ol>
        @endif
    </div>   
    @endif
  </section>
  @endif
@endif

<script>
AOS.init({
  duration: 1000,
  once: true
});
</script>

@push('style')
  <style>
      .pend-section {
          padding: 0 8% !important;
          margin-bottom: 40px;        
      }
  </style>
@endpush
@endsection
