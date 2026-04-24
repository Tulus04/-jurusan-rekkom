@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('content')
    <div class="container-lg px-0">
        <nav aria-label="breadcrumb" class="mb-4 mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><strong>Tambah Kategori Baru</strong></div>
                    <div class="card-body">
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Contoh: Akademik, Kegiatan" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Slug akan dibuat otomatis dari nama.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
