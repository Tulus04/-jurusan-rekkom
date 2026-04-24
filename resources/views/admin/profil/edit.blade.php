@extends('layouts.admin')
@section('title', 'Profil Jurusan')
@section('content')
<div class="container-lg px-0">
    <nav aria-label="breadcrumb" class="mb-4 mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Jurusan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Profil Jurusan</h1>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($kunciProfil as $kunci => $label)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>{{ $label }}</strong>
                    @if($profil[$kunci]->gambar)
                        <span class="badge bg-success">Gambar tersedia</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="profil_{{ $kunci }}_nilai" class="form-label">Konten <span class="text-danger">*</span></label>
                                <textarea class="form-control tinymce-editor"
                                          id="profil_{{ $kunci }}_nilai"
                                          name="profil[{{ $kunci }}][nilai]"
                                          rows="6">{{ old("profil.{$kunci}.nilai", $profil[$kunci]->nilai ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="profil_{{ $kunci }}_gambar" class="form-label">Gambar Pendukung</label>
                                <input type="file"
                                       class="form-control @error("profil.{$kunci}.gambar") is-invalid @enderror"
                                       id="profil_{{ $kunci }}_gambar"
                                       name="profil[{{ $kunci }}][gambar]"
                                       accept="image/*">
                                @error("profil.{$kunci}.gambar")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">JPG, PNG, WebP. Maks: 2MB</div>
                                @if($profil[$kunci]->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $profil[$kunci]->gambar) }}"
                                             class="img-fluid rounded" style="max-height:150px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                <svg class="icon me-1"><use xlink:href="{{ asset('admin/icons/sprites/free.svg#cil-save') }}"></use></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- TinyMCE 7 Free (GPL - jsDelivr CDN) --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '.tinymce-editor',
        height: 250,
        menubar: false,
        plugins: 'lists link image table code wordcount',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',
        content_css: false,
        skin: (document.documentElement.dataset.coreuiTheme === 'dark') ? 'oxide-dark' : 'oxide',
        content_style: (document.documentElement.dataset.coreuiTheme === 'dark')
            ? 'body { background-color: #1e1e2d; color: #e4e4e4; }'
            : '',
        branding: false,
        promotion: false,
        license_key: 'gpl',
    });
});
</script>
@endpush
