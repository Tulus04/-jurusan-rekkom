@extends('layouts.admin')
@section('title', 'Informasi Kontak')
@section('content')
<div class="container-lg px-0">
    <nav aria-label="breadcrumb" class="mb-4 mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Informasi Kontak</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Informasi Kontak</h1>
    </div>

    <form action="{{ route('admin.kontak.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Info Kontak Utama --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Informasi Utama</strong></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat" name="alamat"
                                      rows="3">{{ old('alamat', $kontak->alamat ?? '') }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   value="{{ old('email', $kontak->email ?? '') }}"
                                   placeholder="info@rekkom.ac.id">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                   id="telepon" name="telepon"
                                   value="{{ old('telepon', $kontak->telepon ?? '') }}"
                                   placeholder="(0541) 7771353">
                            @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="koordinat" class="form-label">Koordinat (Google Maps)</label>
                            <input type="text" class="form-control @error('koordinat') is-invalid @enderror"
                                   id="koordinat" name="koordinat"
                                   value="{{ old('koordinat', $kontak->koordinat ?? '') }}"
                                   placeholder="-0.4948,117.1436">
                            @error('koordinat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Format: lat,lng (contoh: -0.4948,117.1436)</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Media Sosial</strong></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="instagram" class="form-label">
                                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-camera') }}"></use></svg>
                                Instagram
                            </label>
                            <input type="url" class="form-control @error('instagram') is-invalid @enderror"
                                   id="instagram" name="instagram"
                                   value="{{ old('instagram', $kontak->instagram ?? '') }}"
                                   placeholder="https://instagram.com/...">
                            @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">
                                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-thumb-up') }}"></use></svg>
                                Facebook
                            </label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                   id="facebook" name="facebook"
                                   value="{{ old('facebook', $kontak->facebook ?? '') }}"
                                   placeholder="https://facebook.com/...">
                            @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="youtube" class="form-label">
                                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-video') }}"></use></svg>
                                YouTube
                            </label>
                            <input type="url" class="form-control @error('youtube') is-invalid @enderror"
                                   id="youtube" name="youtube"
                                   value="{{ old('youtube', $kontak->youtube ?? '') }}"
                                   placeholder="https://youtube.com/...">
                            @error('youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="tiktok" class="form-label">
                                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-music-note') }}"></use></svg>
                                TikTok
                            </label>
                            <input type="url" class="form-control @error('tiktok') is-invalid @enderror"
                                   id="tiktok" name="tiktok"
                                   value="{{ old('tiktok', $kontak->tiktok ?? '') }}"
                                   placeholder="https://tiktok.com/...">
                            @error('tiktok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">
                                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-briefcase') }}"></use></svg>
                                LinkedIn
                            </label>
                            <input type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                   id="linkedin" name="linkedin"
                                   value="{{ old('linkedin', $kontak->linkedin ?? '') }}"
                                   placeholder="https://linkedin.com/in/...">
                            @error('linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-save') }}"></use></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
