@extends('layouts.app')

@section('content')

<!-- ======= Breadcrumb ======= -->
<div class="guest-breadcrumb py-2 px-3">
  <a href="#">Home</a> / <span>Detail Artikel</span>
</div>

<section class="guest-artikel-detail-section container my-5">
  <div class="row">
    <div class="guest-artikel-layout">
      <!-- Konten Artikel -->
      <div class="col-lg-8 col-md-12 w-auto">
        <h1 class="guest-artikel-detail-title">
          {{ $artikel->judul }}
        </h1>      

        <p class="guest-artikel-detail-meta">
          Fahutan, Teknologi Hasil Hutan &nbsp; | &nbsp; {{ \Carbon\Carbon::parse($artikel->created_at)->locale('id')->translatedFormat('F d, Y') }}
        </p>

        <div class="guest-artikel-detail-image mb-4">
          <img src="{{ asset($artikel->foto) }}" alt="Detail Artikel">
          @if($artikel->sdgs)
            <span class="guest-artikel-detail-tag"
                style="background-color: {{ $artikel->sdgs->badgeColor() }}; color: white;">
                {{ $artikel->sdgs->nama_sdgs }}
            </span>
          @endif  
        </div>        

        <div class="guest-artikel-detail-content" style="text-align: justify;">            
            @php
                $text = $artikel->deskripsi ?? '-';
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
        </div>
      </div>

      <!-- SIDEBAR -->
      <aside class="guest-artikel-sidebar">

        <div class="guest-artikel-searchbox">          
          <form action="{{ route('artikel.home') }}" method="GET">
            <input type="text" name="q" placeholder="Cari Judul Artikel..." value="{{ request('q') }}" class="guest-artikel-search">
          </form>
        </div>

        <!-- Dropdown Kategori Artikel -->
        <details class="guest-dropdown mobile-only">
          <summary>Kategori Artikel</summary>
          <ul class="guest-artikel-detail-categories">
            @foreach ($kategoris as $kategori)
              <li>
                <a href="{{ route('artikels.kategori', $kategori->id) }}" class="text-decoration-none text-dark">
                  {{ $kategori->nama }}
                </a>
              </li>
            @endforeach
          </ul>
        </details>

        <!-- Sidebar versi desktop -->
        <div class="guest-artikel-detail-sidebar desktop-only">
          <h4 class="guest-artikel-detail-sidebar-title">Kategori Artikel</h4>
          <ul class="guest-artikel-detail-categories">
            @foreach ($kategoris as $kategori)
              <li>
                <a href="{{ route('artikels.kategori', $kategori->id) }}" class="text-decoration-none text-dark">
                  {{ $kategori->nama }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        <!-- Dropdown Berita Terkini -->
        <details class="guest-dropdown mobile-only">
          <summary>Berita Terkini</summary>
          <ul class="guest-artikel-detail-latest">
            @foreach ($latestArtikels as $latest)
            <li>
                <a href="{{ route('artikel.show', $latest->id) }}" class="text-decoration-none">{{ $latest->judul }}</a>
                <span class="date">
                    {{ \Carbon\Carbon::parse($latest->tanggal)->format('M d, Y') }}
                </span>
            </li>
            @endforeach
          </ul>
        </details>

        <!-- Sidebar versi desktop -->
        <div class="guest-artikel-detail-sidebar desktop-only">
          <h4 class="guest-artikel-detail-sidebar-title">Berita Terkini</h4>
          <ul class="guest-artikel-detail-latest">
            @foreach ($latestArtikels as $latest)
            <li>
                <a href="{{ route('artikel.show', $latest->id) }}" class="text-decoration-none">{{ $latest->judul }}</a>
                <span class="date">
                    {{ \Carbon\Carbon::parse($latest->tanggal)->format('M d, Y') }}
                </span>
            </li>
            @endforeach
          </ul>
        </div>

      </aside>
    </div>    
  </div>
</section>

@endsection
