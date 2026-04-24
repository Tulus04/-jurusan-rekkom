{{--
|--------------------------------------------------------------------------
| Halaman Dashboard Admin (dari CoreUI index.html)
|--------------------------------------------------------------------------
| Dashboard cards mengikuti struktur template CoreUI.
| Konten disesuaikan untuk Jurusan RK.
|--------------------------------------------------------------------------
--}}
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active"><span>Dashboard</span></li>
@endsection

@section('content')

    {{-- Stat Cards (mengikuti format card dari index.html template) --}}
    <div class="row g-4 mb-4">

        {{-- Card: Total Berita --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">0</div>
                        <div>Total Berita</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-options') }}"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.berita.index') }}">Kelola Berita</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
            </div>
        </div>
        <!-- /.col-->

        {{-- Card: Total Dosen --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">0</div>
                        <div>Total Dosen</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-options') }}"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.dosen.index') }}">Kelola Dosen</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
            </div>
        </div>
        <!-- /.col-->

        {{-- Card: Total Galeri --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">0</div>
                        <div>Total Galeri</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-options') }}"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.galeri.index') }}">Kelola Galeri</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
            </div>
        </div>
        <!-- /.col-->

        {{-- Card: Pesan Masuk --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">0</div>
                        <div>Pesan Masuk</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-options') }}"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.kontak.index') }}">Lihat Pesan</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"></div>
            </div>
        </div>
        <!-- /.col-->

    </div>
    <!-- /.row-->

    {{-- Card Selamat Datang --}}
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h4>
            <p class="text-body-secondary">
                Ini adalah panel admin website Jurusan Rekayasa Komputer - Politeknik Pertanian Negeri Samarinda.
                Gunakan menu di sidebar untuk mengelola konten website.
            </p>
        </div>
    </div>

@endsection