{{-- Form Program Studi --}}
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3"><div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $prodi->nama ?? '') }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenjang') is-invalid @enderror" id="jenjang" name="jenjang" required>
                        <option value="">Pilih</option>
                        @foreach(['D3','D4','S1'] as $j)
                            <option value="{{ $j }}" {{ old('jenjang', $prodi->jenjang ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenjang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="akreditasi" class="form-label">Akreditasi</label>
                    <input type="text" class="form-control @error('akreditasi') is-invalid @enderror" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $prodi->akreditasi ?? '') }}" placeholder="A/B/C/Unggul">
                    @error('akreditasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $prodi->deskripsi ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="visi" class="form-label">Visi</label>
                <textarea class="form-control" id="visi" name="visi" rows="2">{{ old('visi', $prodi->visi ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="misi" class="form-label">Misi</label>
                <textarea class="form-control" id="misi" name="misi" rows="3">{{ old('misi', $prodi->misi ?? '') }}</textarea>
            </div>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3"><div class="card-header"><strong>Gambar</strong></div><div class="card-body">
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
            @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div class="mt-2"><img id="gambar-preview" src="{{ isset($prodi) && $prodi->gambar ? asset('storage/' . $prodi->gambar) : '' }}" class="img-fluid rounded {{ isset($prodi) && $prodi->gambar ? '' : 'd-none' }}" style="max-height:200px;"></div>
        </div></div>
        <div class="card mb-3"><div class="card-header"><strong>Status</strong></div><div class="card-body">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $prodi->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div></div>
    </div>
</div>
@push('scripts')<script>function previewImage(e){var r=new FileReader();r.onload=function(){var p=document.getElementById('gambar-preview');p.src=r.result;p.classList.remove('d-none');};r.readAsDataURL(e.target.files[0]);}</script>@endpush
