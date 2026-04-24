{{-- Form dosen — reusable partial --}}
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                        id="nama" name="nama" value="{{ old('nama', $dosen->nama ?? '') }}"
                        placeholder="Nama lengkap dosen" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nidn" class="form-label">NIDN</label>
                        <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                            id="nidn" name="nidn" value="{{ old('nidn', $dosen->nidn ?? '') }}"
                            placeholder="Nomor Induk Dosen Nasional">
                        @error('nidn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                            id="jabatan" name="jabatan" value="{{ old('jabatan', $dosen->jabatan ?? '') }}"
                            placeholder="Contoh: Lektor, Asisten Ahli">
                        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email', $dosen->email ?? '') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                            id="telepon" name="telepon" value="{{ old('telepon', $dosen->telepon ?? '') }}">
                        @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                    <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror"
                        id="bidang_keahlian" name="bidang_keahlian"
                        value="{{ old('bidang_keahlian', $dosen->bidang_keahlian ?? '') }}"
                        placeholder="Contoh: Jaringan Komputer, Data Science">
                    @error('bidang_keahlian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografi Singkat</label>
                    <textarea class="form-control @error('bio') is-invalid @enderror"
                        id="bio" name="bio" rows="4"
                        placeholder="Biografi singkat dosen">{{ old('bio', $dosen->bio ?? '') }}</textarea>
                    @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><strong>Foto</strong></div>
            <div class="card-body">
                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                    id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <div class="form-text">Format: JPG, PNG, WebP. Maks: 2MB</div>
                <div class="mt-2">
                    <img id="gambar-preview"
                        src="{{ isset($dosen) && $dosen->foto ? asset('storage/' . $dosen->foto) : '' }}"
                        alt="Preview"
                        class="img-fluid rounded {{ isset($dosen) && $dosen->foto ? '' : 'd-none' }}"
                        style="max-height: 200px;">
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"><strong>Pengaturan</strong></div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="urutan" class="form-label">Urutan Tampil</label>
                    <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                        id="urutan" name="urutan" value="{{ old('urutan', $dosen->urutan ?? 0) }}" min="0">
                    @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox"
                        id="is_active" name="is_active" value="1"
                        {{ old('is_active', $dosen->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
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
