{{--
|--------------------------------------------------------------------------
| Layout Admin Panel (Template CoreUI v5.3.0)
|--------------------------------------------------------------------------
| Layout utama admin panel, mengikuti persis struktur dari
| coreui_admin/src/views/index.html
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Jurusan RK</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/favicon/favicon-16x16.png') }}">

    {{-- Vendors styles --}}
    <link rel="stylesheet" href="{{ asset('admin/css/vendors/simplebar.min.css') }}">

    {{-- CoreUI CSS --}}
    <link href="{{ asset('admin/css/coreui.min.css') }}" rel="stylesheet">

    {{-- Custom styles (dari style.scss template) --}}
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    {{-- Config & Color Modes JS (harus di head seperti template asli) --}}
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src="{{ asset('admin/js/color-modes.js') }}"></script>

    @stack('styles')
    @yield('styles')
</head>

<body>

    {{-- ==================== SIDEBAR ==================== --}}
    @include('components.admin.sidebar')

    {{-- ==================== WRAPPER UTAMA ==================== --}}
    <div class="wrapper d-flex flex-column min-vh-100">

        {{-- Header --}}
        @include('components.admin.header')

        {{-- Konten Utama --}}
        <div class="body flex-grow-1">
            <div class="container-lg px-4">

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')

            </div>
        </div>

        {{-- Footer (persis dari template) --}}
        <footer class="footer px-4">
            <div><a href="https://coreui.io">CoreUI </a><a
                    href="https://coreui.io/product/free-bootstrap-admin-template/">Bootstrap Admin Template</a> &copy;
                {{ date('Y') }} creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/docs/">CoreUI UI Components</a>
            </div>
        </footer>

    </div>

    {{-- CoreUI and necessary plugins (persis dari template) --}}
    <script src="{{ asset('admin/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js') }}"></script>
    <script>
        const header = document.querySelector('header.header');

        document.addEventListener('scroll', () => {
            if (header) {
                header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
            }
        });
    </script>

    {{-- jQuery (dependency DataTables.js) --}}
    <script src="{{ asset('admin/vendor/jquery/jquery-3.7.1.min.js') }}"></script>

    {{-- SweetAlert2 (jQuery-free) --}}
    <script src="{{ asset('admin/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- CSRF Token untuk AJAX --}}
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>

    @stack('scripts')
    @yield('scripts')

</body>

</html>