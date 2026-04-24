{{-- Form Fasilitas --}}
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3"><div class="card-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $fasilitas->nama ?? '') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon Class</label>
                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $fasilitas->icon ?? '') }}" placeholder="Contoh: cil-laptop, cil-building">
                <div class="form-text">Gunakan icon class dari CoreUI Icons</div>
            </div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3"><div class="card-header"><strong>Gambar</strong></div><div class="card-body">
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div class="mt-2"><img id="gambar-preview" src="{{ isset($fasilitas) && $fasilitas->gambar ? asset('storage/' . $fasilitas->gambar) : '' }}" class="img-fluid rounded {{ isset($fasilitas) && $fasilitas->gambar ? '' : 'd-none' }}" style="max-height:200px;"></div>
        </div></div>
        <div class="card mb-3"><div class="card-header"><strong>Pengaturan</strong></div><div class="card-body">
            <div class="mb-3"><label for="urutan" class="form-label">Urutan</label><input type="number" class="form-control" id="urutan" name="urutan" value="{{ old('urutan', $fasilitas->urutan ?? 0) }}" min="0"></div>
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $fasilitas->is_active ?? true) ? 'checked' : '' }}><label class="form-check-label" for="is_active">Aktif</label></div>
        </div></div>
    </div>
</div>
@push('scripts')<script>function previewImage(e){var r=new FileReader();r.onload=function(){var p=document.getElementById('gambar-preview');p.src=r.result;p.classList.remove('d-none');};r.readAsDataURL(e.target.files[0]);}</script>@endpush
