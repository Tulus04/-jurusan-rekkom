{{-- Form fields slider — dipakai di create.blade.php dan edit.blade.php --}}

<div class="row">
    <div class="col-md-8">
        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Slider <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                id="judul" name="judul"
                value="{{ old('judul', $slider->judul ?? '') }}"
                placeholder="Masukkan judul slider" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                id="deskripsi" name="deskripsi" rows="3"
                placeholder="Deskripsi singkat slider (opsional)">{{ old('deskripsi', $slider->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Teks & URL --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tombol_teks" class="form-label">Teks Tombol</label>
                <input type="text" class="form-control @error('tombol_teks') is-invalid @enderror"
                    id="tombol_teks" name="tombol_teks"
                    value="{{ old('tombol_teks', $slider->tombol_teks ?? '') }}"
                    placeholder="Contoh: Selengkapnya">
                @error('tombol_teks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="tombol_url" class="form-label">URL Tombol</label>
                <input type="text" class="form-control @error('tombol_url') is-invalid @enderror"
                    id="tombol_url" name="tombol_url"
                    value="{{ old('tombol_url', $slider->tombol_url ?? '') }}"
                    placeholder="Contoh: /profil/visi-misi">
                @error('tombol_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-4">
        {{-- Gambar --}}
        <div class="mb-3">
            <label for="gambar" class="form-label">
                Gambar Slider
                @if(!isset($slider)) <span class="text-danger">*</span> @endif
            </label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                id="gambar" name="gambar" accept="image/*"
                onchange="previewImage(event)">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Format: JPG, PNG, WebP. Maks: 2MB. Rasio: 16:9</div>

            {{-- Preview --}}
            <div class="mt-2">
                <img id="gambar-preview"
                    src="{{ isset($slider) && $slider->gambar ? asset('storage/' . $slider->gambar) : '' }}"
                    alt="Preview"
                    class="img-fluid rounded {{ isset($slider) && $slider->gambar ? '' : 'd-none' }}"
                    style="max-height: 200px;">
            </div>
        </div>

        {{-- Urutan --}}
        <div class="mb-3">
            <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                id="urutan" name="urutan"
                value="{{ old('urutan', $slider->urutan ?? 0) }}"
                min="0" required>
            @error('urutan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox"
                    id="is_active" name="is_active" value="1"
                    {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Slider Aktif</label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('gambar-preview');
            preview.src = reader.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
