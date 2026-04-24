@extends('layouts.admin')
@section('title', 'Tambah Dosen')
@section('content')
    <div class="container-lg px-0">
        <nav aria-label="breadcrumb" class="mb-4 mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dosen.index') }}">Dosen</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Dosen Baru</h1>
            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
        <form action="{{ route('admin.dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.dosen._form')
            <div class="mt-4 mb-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>
@endsection
