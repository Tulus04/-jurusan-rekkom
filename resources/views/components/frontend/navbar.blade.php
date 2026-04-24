{{--
|--------------------------------------------------------------------------
| Komponen Navbar (Navigasi utama)
|--------------------------------------------------------------------------
| Navbar dengan logo Politani + "REKAYASA DAN KOMPUTER",
| menu dropdown sesuai screenshot.
| Mengikuti struktur Eterna template index.html baris 58-101.
|--------------------------------------------------------------------------
--}}
<div class="branding">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('frontend/img/logo-politani.png') }}" alt="Logo Politani"
                style="height: 40px; margin-right: 8px;">
            <h1 class="sitename">REKAYASA DAN KOMPUTER</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        BERANDA
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="{{ request()->routeIs('profil.*') ? 'active' : '' }}">
                        <span>PROFIL</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('profil.visi-misi') }}">Visi & Misi</a></li>
                        <li><a href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ route('profil.struktur') }}">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="{{ request()->routeIs('prodi.*') ? 'active' : '' }}">
                        <span>PROGRAM STUDI</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="#">Teknologi Geomatika</a></li>
                        <li><a href="#">Sistem Informasi Akademik</a></li>
                        <li><a href="#">Teknologi Rekayasa Perangkat Lunak</a></li>
                        <li><a href="#">Teknologi Rekayasa Geomatika dan Survei</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <span>KEMAHASISWAAN</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="#">Organisasi Mahasiswa</a></li>
                        <li><a href="#">Kegiatan Mahasiswa</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <span>TRIDHARMA</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="#">Penelitian</a></li>
                        <li><a href="#">Pengabdian Masyarakat</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">
                        BERITA
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">
                        HUBUNGI KAMI
                    </a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</div>
</header>