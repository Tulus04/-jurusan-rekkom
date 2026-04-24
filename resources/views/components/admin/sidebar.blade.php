{{--
|--------------------------------------------------------------------------
| Komponen Sidebar Admin (dari CoreUI index.html baris 49-220)
|--------------------------------------------------------------------------
| Menggunakan SVG icon sprites persis seperti template asli.
| Menu disesuaikan untuk website Jurusan RK.
|--------------------------------------------------------------------------
--}}
<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('admin/brand/coreui.svg#full') }}"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('admin/brand/coreui.svg#signet') }}"></use>
            </svg>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>

        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link{{ request()->routeIs('admin.dashboard') ? '' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-speedometer') }}"></use>
                </svg> Dashboard
            </a>
        </li>

        <li class="nav-title">Kelola Konten</li>

        {{-- Profil Jurusan --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.profil.edit') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-building') }}"></use>
                </svg> Profil Jurusan
            </a>
        </li>

        {{-- Slider Hero --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.slider.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-image-plus') }}"></use>
                </svg> Slider Hero
            </a>
        </li>

        {{-- Berita --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.berita.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-newspaper') }}"></use>
                </svg> Berita
            </a>
        </li>

        {{-- Dosen & Staff --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dosen.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-people') }}"></use>
                </svg> Dosen &amp; Staff
            </a>
        </li>

        {{-- Program Studi --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.program-studi.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-education') }}"></use>
                </svg> Program Studi
            </a>
        </li>

        {{-- Galeri --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.galeri.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-camera') }}"></use>
                </svg> Galeri
            </a>
        </li>

        {{-- Fasilitas --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.fasilitas.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-laptop') }}"></use>
                </svg> Fasilitas
            </a>
        </li>

        <li class="nav-divider"></li>
        <li class="nav-title">Lainnya</li>

        {{-- Pesan Masuk --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.kontak.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-envelope-closed') }}"></use>
                </svg> Pesan Masuk
            </a>
        </li>

        {{-- Logout --}}
        <li class="nav-item">
            <a class="nav-link text-danger" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-account-logout') }}"></use>
                </svg> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>

    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
</div>