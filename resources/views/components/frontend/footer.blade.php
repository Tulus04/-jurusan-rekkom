{{--
|--------------------------------------------------------------------------
| Komponen Footer (Eterna template)
|--------------------------------------------------------------------------
| 4 kolom footer sesuai screenshot:
| 1. Rekayasa dan Komputer (alamat, telepon, email)
| 2. Tentang Jurusan (Visi&Misi, Struktur, Akreditasi, Hubungi Kami)
| 3. Web Prodi (4 nama prodi)
| 4. Follow Kami (deskripsi + social icons)
| Mengikuti Eterna index.html baris 365-443.
|--------------------------------------------------------------------------
--}}
<footer id="footer" class="footer position-relative dark-background">

    <div class="container footer-top">
        <div class="row gy-4">

            {{-- Kolom 1: Informasi Jurusan --}}
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="{{ route('home') }}" class="d-flex align-items-center">
                    <span class="sitename">Rekayasa dan Komputer</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Samaritulung, Sungai Keledang,</p>
                    <p>Kec. Samarinda Seberang,</p>
                    <p>Kota Samarinda,</p>
                    <p>Kalimantan Timur, 75131</p>
                    <p class="mt-3"><strong>No. Telepon:</strong> <span>(0541) 260421, 260680</span></p>
                    <p><strong>Email:</strong> <span>politanismd@gmail.com</span></p>
                </div>
            </div>

            {{-- Kolom 2: Tentang Jurusan --}}
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Tentang Jurusan</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profil.visi-misi') }}">Visi&Misi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profil.struktur') }}">Struktur
                            Organisasi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Akreditasi Program Studi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Web Prodi --}}
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Web Prodi</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Teknologi Geomatika</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Sistem Informasi Akuntansi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Teknologi Rekayasa Perangkat Lunak</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Teknologi Rekayasa Geomatika dan Survei</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Follow Kami --}}
            <div class="col-lg-4 col-md-12">
                <h4>Follow Kami</h4>
                <p>Follow Social Media Kami untuk Mendapatkan Update Informasi Terbaru Seputar Kampus.</p>
                <div class="social-links d-flex">
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>
            &copy; Copyright
            <strong class="px-1 sitename">Rekayasa&Komputer</strong>
            <span>All Rights Reserved</span>
        </p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>

</footer>