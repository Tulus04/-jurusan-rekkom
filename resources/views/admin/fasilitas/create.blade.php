@extends('layouts.admin')
@section('title', 'Tambah Fasilitas')
@section('content')
<div class="container-lg px-0">
    <nav aria-label="breadcrumb" class="mb-4 mt-3"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item"><a href="{{ route('admin.fasilitas.index') }}">Fasilitas</a></li><li class="breadcrumb-item active">Tambah</li></ol></nav>
    <div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3 mb-0">Tambah Fasilitas Baru</h1><a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">← Kembali</a></div>
    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">@csrf @include('admin.fasilitas._form')
        <div class="mt-4 mb-4"><button type="submit" class="btn btn-primary">Simpan</button><a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary ms-2">Batal</a></div></form>
</div>
@endsection
