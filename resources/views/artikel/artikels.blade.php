@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumb ======= -->
    <div class="guest-breadcrumb py-2 px-3">
        <a href="#">Home</a> / <span>Artikel</span>
    </div>

    <section class="guest-artikel-detail-section container my-5">
        <div class="row">
            <!-- Gallery -->
            <h2 class="guest-galery-title">Artikel</h2>
            <p class="guest-galery-desc">
                Artikel-artikel ini merupakan media untuk menyampaikan informasi, penelitian, serta pemikiran dari
                Departemen Hasil Hutan, yang diharapkan dapat memberikan kontribusi bagi ilmu pengetahuan dan masyarakat.
            </p>

            <div class="guest-artikel-layout">
                <main class="guest-artikel-main h-100">
                    @if ($artikels->isEmpty())
                        <div class="d-flex justify-content-center align-items-center"
                            style="min-height: 50vh; text-align: center;">
                            <div>
                                <p class="guest-no-result text-secondary mb-3">
                                    Maaf, saat ini artikel <b> "{{ $keyword }}"</b> yang anda cari tidak tersedia.
                                </p>
                                <br><span class="fw-bold text-secondary">Bantuan:</span>
                                <div class="text-secondary">
                                    <ul class="mt-2" style="list-style: disc; display: inline-block; text-align: left;">
                                        <li>Format pencarian yang benar ialah <b> judul artikel</b>.</li>
                                        <li>Pastikan penulisan judul sudah benar dan tidak ada typo.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="guest-artikel-featured-grid">
                            @foreach ($artikels->take(4) as $item)
                                <a href="{{ route('artikel.show', $item->id) }}"
                                    class="guest-artikel-featured-card text-decoration-none text-dark">
                                    <img src="{{ asset($item->foto) }}" alt="featured">
                                    <div class="guest-artikel-featured-meta">
                                        <span class="guest-artikel-badge"
                                            style="background-color: {{ $item->kategoriartikel->getBadgeColor() }}; color: #fff;">{{ $item->kategoriartikel->nama ?? '-' }}</span>
                                        <span
                                            class="guest-artikel-date">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                        <h3>{{ $item->judul }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="guest-artikel-columns">
                            @foreach ($pagination->chunk(3) as $column)
                                <div class="guest-artikel-list-col">
                                    @foreach ($column as $item)
                                        <a href="{{ route('artikel.show', $item->id) }}"
                                            class="guest-artikel-list-item text-decoration-none text-dark">
                                            <img src="{{ asset($item->foto) }}" alt="">
                                            <div class="guest-artikel-list-body">
                                                <span class="guest-artikel-badge"
                                                    style="background-color: {{ $item->kategoriartikel->getBadgeColor() }}; color: #fff;">{{ $item->kategoriartikel->nama ?? '-' }}</span>
                                                <h4>{{ $item->judul }}</h4>
                                                <div class="guest-artikel-list-meta">
                                                    <span
                                                        class="guest-artikel-date">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="guest-galery-pagination d-flex align-items-center justify-content-center mt-4">

                            {{-- Tombol Previous --}}
                            @if ($pagination->onFirstPage())
                                <button class="guest-galery-prev disabled">&lt;</button>
                            @else
                                <a href="{{ $pagination->previousPageUrl() }}" class="guest-galery-prev">&lt;</a>
                            @endif

                            {{-- Nomor Halaman --}}
                            <div class="guest-galery-pages d-flex">
                                @foreach ($pagination->getUrlRange(1, $pagination->lastPage()) as $page => $url)
                                    <a href="{{ $url }}"
                                        class="guest-galery-page {{ $page == $pagination->currentPage() ? 'active' : '' }}"
                                        style="background-color: {{ $page == $pagination->currentPage() ? '#FFD700' : '#eaeaea' }}; color: {{ $page == $pagination->currentPage() ? '#fff' : '#333' }}; padding: 6px 12px; border-radius: 6px; margin: 0 4px; font-weight: 600; text-decoration: none; transition: 0.2s;">{{ $page }}</a>
                                @endforeach
                            </div>

                            {{-- Tombol Next --}}
                            @if ($pagination->hasMorePages())
                                <a href="{{ $pagination->nextPageUrl() }}" class="guest-galery-next">&gt;</a>
                            @else
                                <button class="guest-galery-next disabled">&gt;</button>
                            @endif
                        </div>
                    @endif
                </main>

                <!-- SIDEBAR -->
                <aside class="guest-artikel-sidebar">

                    <div class="guest-artikel-searchbox">
                        <form action="{{ route('artikel.home') }}" method="GET">
                            <input type="text" name="q" placeholder="Cari Judul Artikel..."
                                value="{{ request('q') }}" class="guest-artikel-search">
                        </form>
                    </div>

                    <!-- Dropdown Kategori Artikel -->
                    <details class="guest-dropdown mobile-only">
                        <summary>Kategori Artikel</summary>
                        <ul class="guest-artikel-detail-categories">
                            @foreach ($kategoris as $kategori)
                                <li>
                                    <a href="{{ route('artikels.kategori', $kategori->id) }}"
                                        class="text-decoration-none text-dark">
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
                                    <a href="{{ route('artikels.kategori', $kategori->id) }}"
                                        class="text-decoration-none text-dark">
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
                                    <a href="{{ route('artikel.show', $latest->id) }}"
                                        class="text-decoration-none">{{ $latest->judul }}</a>
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
                                    <a href="{{ route('artikel.show', $latest->id) }}"
                                        class="text-decoration-none">{{ $latest->judul }}</a>
                                    <span class="date">
                                        {{ \Carbon\Carbon::parse($latest->tanggal)->format('M d, Y') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </aside>

            </div> <!-- layout -->
        </div> <!-- container -->
    </section>
@endsection
