{{--
|--------------------------------------------------------------------------
| Halaman Login (dari CoreUI login.html)
|--------------------------------------------------------------------------
| Form login mengikuti persis struktur login.html template CoreUI:
| input-group dengan SVG icon, tombol Login.
| Validasi error ditampilkan sebagai CoreUI alert.
|--------------------------------------------------------------------------
--}}
<x-guest-layout>

    <h1>Login</h1>
    <p class="text-body-secondary">Masuk ke panel admin</p>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Validation Errors (CoreUI alert style) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Login gagal:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email (input-group dengan SVG icon seperti template) --}}
        <div class="input-group mb-3">
            <span class="input-group-text">
                <svg class="icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-user') }}"></use>
                </svg>
            </span>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email') }}" placeholder="Email" required autofocus autocomplete="username">
        </div>

        {{-- Password (input-group dengan SVG icon seperti template) --}}
        <div class="input-group mb-4">
            <span class="input-group-text">
                <svg class="icon">
                    <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-lock-locked') }}"></use>
                </svg>
            </span>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                placeholder="Password" required autocomplete="current-password">
        </div>

        {{-- Tombol login & forgot (persis layout dari template) --}}
        <div class="row">
            <div class="col-6">
                <button class="btn btn-primary px-4" type="submit">Login</button>
            </div>
            @if (Route::has('password.request'))
                <div class="col-6 text-end">
                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">Lupa password?</a>
                </div>
            @endif
        </div>
    </form>

</x-guest-layout>