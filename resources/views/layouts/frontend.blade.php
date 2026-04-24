{{--
|--------------------------------------------------------------------------
| Layout Frontend (Template Eterna - BootstrapMade)
|--------------------------------------------------------------------------
| Layout utama untuk halaman publik website Jurusan Rekayasa Komputer.
| Menggunakan template Eterna dengan Bootstrap 5.3.
|
| Sections yang tersedia:
| - @section('title') : Judul halaman
| - @section('meta') : Meta tags tambahan
| - @section('styles') : CSS tambahan per halaman
| - @section('content') : Konten utama halaman
| - @section('scripts') : JavaScript tambahan per halaman
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul dinamis per halaman --}}
    <title>@yield('title', 'Jurusan Rekayasa Komputer') - Politani Samarinda</title>

    {{-- Meta SEO --}}
    <meta name="description"
        content="@yield('meta_description', 'Website resmi Jurusan Rekayasa Komputer - Politeknik Pertanian Negeri Samarinda')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'Rekayasa Komputer, Politani Samarinda, Politeknik Pertanian')">

    @yield('meta')

    {{-- Favicons --}}
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Vendor CSS --}}
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    {{-- Main CSS Eterna --}}
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">

    {{-- Custom CSS Jurusan RK --}}
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

    {{-- CSS tambahan per halaman --}}
    @yield('styles')
</head>

<body class="@yield('body_class', 'index-page')">

    {{-- ==================== HEADER ==================== --}}
    @include('components.frontend.topbar')
    @include('components.frontend.navbar')

    {{-- ==================== KONTEN UTAMA ==================== --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    @include('components.frontend.footer')

    {{-- Scroll Top Button --}}
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    {{-- Preloader --}}
    <div id="preloader"></div>

    {{-- Vendor JS --}}
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    {{-- Main JS Eterna --}}
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    {{-- JavaScript tambahan per halaman --}}
    @yield('scripts')

</body>

</html>