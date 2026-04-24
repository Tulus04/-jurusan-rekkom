{{--
|--------------------------------------------------------------------------
| Layout App (Breeze profile pages — sama dengan admin layout)
|--------------------------------------------------------------------------
| Layout ini dipakai oleh halaman profil user dari Breeze.
| Menggunakan admin layout yang sama agar konsisten.
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
    <title>{{ config('app.name', 'Jurusan RK') }}</title>

    {{-- Vendors styles --}}
    <link rel="stylesheet" href="{{ asset('admin/css/vendors/simplebar.min.css') }}">
    {{-- CoreUI CSS --}}
    <link href="{{ asset('admin/css/coreui.min.css') }}" rel="stylesheet">
    {{-- Custom styles --}}
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    {{-- Config & Color Modes --}}
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <script src="{{ asset('admin/js/color-modes.js') }}"></script>
</head>

<body>

    @include('components.admin.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100">
        @include('components.admin.header')

        <div class="body flex-grow-1">
            <div class="container-lg px-4">
                @isset($header)
                    <div class="mb-4">{{ $header }}</div>
                @endisset

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                    </div>
                @endif

                <main>{{ $slot }}</main>
            </div>
        </div>

        <footer class="footer px-4">
            <div><a href="https://coreui.io">CoreUI </a><a
                    href="https://coreui.io/product/free-bootstrap-admin-template/">Bootstrap Admin Template</a> &copy;
                {{ date('Y') }} creativeLabs.</div>
            <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/docs/">CoreUI UI Components</a>
            </div>
        </footer>
    </div>

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

</body>

</html>