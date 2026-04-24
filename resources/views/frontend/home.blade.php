{{--
|--------------------------------------------------------------------------
| Halaman Beranda (Home)
|--------------------------------------------------------------------------
| Halaman utama website Jurusan Rekayasa Komputer.
| Layout mengikuti Eterna template index.html:
| Hero → Program Studi → Berita → CTA Politani
|--------------------------------------------------------------------------
--}}
@extends('layouts.frontend')

@section('title', 'Beranda')
@section('body_class', 'index-page')

@section('content')

    {{-- ==================== HERO SECTION ==================== --}}
    {{-- Mengikuti Eterna index.html baris 107-180 --}}
    <section id="hero" class="hero section">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-1.jpg') }}" alt="Kampus Politani Samarinda">
                <div class="carousel-container">
                    <h2>Selamat Datang di <span>Jurusan Rekayasa dan Komputer</span></h2>
                    <p>Jurusan Rekayasa dan Komputer berfokus pada pengembangan teknologi dan sumber daya manusia di bidang
                        rekayasa perangkat lunak, sistem cerdas, dan jaringan komputer.</p>
                    <a href="#prodi" class="btn-get-started">Selengkapnya</a>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="carousel-item">
                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-2.jpg') }}" alt="Laboratorium Komputer">
                <div class="carousel-container">
                    <h2>Fasilitas Modern</h2>
                    <p>Didukung dengan laboratorium dan peralatan terkini untuk menunjang proses pembelajaran yang
                        berkualitas.</p>
                    <a href="#prodi" class="btn-get-started">Lihat Fasilitas</a>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="carousel-item">
                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-3.jpg') }}" alt="Akademik">
                <div class="carousel-container">
                    <h2>Program Studi Unggulan</h2>
                    <p>Kurikulum yang dirancang sesuai kebutuhan industri dengan tenaga pengajar profesional dan
                        berpengalaman.</p>
                    <a href="#prodi" class="btn-get-started">Lihat Program Studi</a>
                </div>
            </div>

            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>

        {{-- Featured Highlights (Eterna index.html baris 148-178) --}}
        <div class="featured container">
            <div class="row gy-4">
                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="featured-item position-relative">
                        <div class="icon"><i class="bi bi-mortarboard icon"></i></div>
                        <h4><a href="#prodi" class="stretched-link">Program Studi</a></h4>
                        <p>Program studi yang dirancang untuk mencetak tenaga ahli di bidang rekayasa komputer.</p>
                    </div>
                </div>

                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="featured-item position-relative">
                        <div class="icon"><i class="bi bi-people icon"></i></div>
                        <h4><a href="#" class="stretched-link">Dosen Berkualitas</a></h4>
                        <p>Tenaga pengajar profesional dengan latar belakang akademik dan industri yang mumpuni.</p>
                    </div>
                </div>

                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="featured-item position-relative">
                        <div class="icon"><i class="bi bi-pc-display icon"></i></div>
                        <h4><a href="#" class="stretched-link">Lab Modern</a></h4>
                        <p>Fasilitas laboratorium komputer modern yang mendukung praktikum dan penelitian.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- ==================== PROGRAM STUDI SECTION ==================== --}}
    {{-- 4 kartu prodi dengan gambar + panel biru bawah, hover membesar, klik ke web prodi --}}
    <section id="prodi" class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Program Studi</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                {{-- Kartu 1: Teknologi Geomatika --}}
                <div class="col-lg-3 col-md-6">
                    <a href="https://tg.politanisamarinda.ac.id" target="_blank" class="prodi-card-link">
                        <div class="prodi-card">
                            <div class="prodi-card-img">
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-1.jpg') }}"
                                    alt="Teknologi Geomatika">
                            </div>
                            <div class="prodi-card-body">
                                <h5>Teknologi Geomatika</h5>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Kartu 2: Sistem Informasi Akademik --}}
                <div class="col-lg-3 col-md-6">
                    <a href="https://sia.politanisamarinda.ac.id" target="_blank" class="prodi-card-link">
                        <div class="prodi-card">
                            <div class="prodi-card-img">
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-2.jpg') }}"
                                    alt="Sistem Informasi Akademik">
                            </div>
                            <div class="prodi-card-body">
                                <h5>Sistem Informasi Akademik</h5>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Kartu 3: Teknologi Rekayasa Geomatika dan Survei --}}
                <div class="col-lg-3 col-md-6">
                    <a href="https://trgs.politanisamarinda.ac.id" target="_blank" class="prodi-card-link">
                        <div class="prodi-card">
                            <div class="prodi-card-img">
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-3.jpg') }}"
                                    alt="Teknologi Rekayasa Geomatika dan Survei">
                            </div>
                            <div class="prodi-card-body">
                                <h5>Teknologi Rekayasa Geomatika dan Survei</h5>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Kartu 4: Teknologi Rekayasa Perangkat Lunak --}}
                <div class="col-lg-3 col-md-6">
                    <a href="https://trpl.politanisamarinda.ac.id" target="_blank" class="prodi-card-link">
                        <div class="prodi-card">
                            <div class="prodi-card-img">
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-1.jpg') }}"
                                    alt="Teknologi Rekayasa Perangkat Lunak">
                            </div>
                            <div class="prodi-card-body">
                                <h5>Teknologi Rekayasa Perangkat Lunak</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ==================== BERITA SECTION ==================== --}}
    {{-- Grid 3x2 berita terbaru, sesuai screenshot --}}
    <section id="berita" class="section berita-section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Seputar Jurusan Rekayasa & Komputer</h2>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @forelse($beritas as $berita)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top"
                                    alt="{{ $berita->judul }}">
                            @else
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-1.jpg') }}" class="card-img-top"
                                    alt="{{ $berita->judul }}">
                            @endif
                            <div class="card-body">
                                <p class="tanggal mb-1">
                                    <i class="bi bi-clock"></i>
                                    {{ $berita->tanggal_publikasi->format('d-m-Y') }}
                                </p>
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text">{{ Str::limit($berita->ringkasan, 120) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Tampilkan placeholder jika belum ada berita --}}
                    @for($i = 0; $i < 6; $i++)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <img src="{{ asset('frontend/img/hero-carousel/hero-carousel-' . (($i % 3) + 1) . '.jpg') }}"
                                    class="card-img-top" alt="Berita placeholder">
                                <div class="card-body">
                                    <p class="tanggal mb-1">
                                        <i class="bi bi-clock"></i>
                                        {{ now()->subDays($i)->format('d-m-Y') }}
                                    </p>
                                    <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. ...</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            {{-- Tombol "Tampilkan Semua" --}}
            <div class="text-center mt-4">
                <a href="{{ route('berita.index') }}" class="btn btn-outline-dark px-4 py-2">Tampilkan Semua</a>
            </div>
        </div>
    </section>

    {{-- ==================== CTA POLITANI SECTION ==================== --}}
    {{-- Background gradient biru + logo Politani, sesuai screenshot --}}
    <section id="cta" class="section cta-politani">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center gy-4">
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('frontend/img/logo-politani.png') }}" class="logo-politani"
                        alt="Logo Politani Samarinda">
                </div>
                <div class="col-lg-8">
                    <h2>POLITANI SAMARINDA,<br>KAMPUS YANG BANYAK PRESTASINYA!</h2>
                    <span class="emoji-trophy">🏆</span>
                    <p class="mt-3">Ayo gabung bersama kami di Politeknik Pertanian Negeri Samarinda Raih masa depan cerah
                        dengan pendidikan vokasi.<br>Yuk, daftar sekarang!</p>
                    <a href="#" class="btn-cta mt-2">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                </div>
            </div>
        </div>
    </section>

@endsection