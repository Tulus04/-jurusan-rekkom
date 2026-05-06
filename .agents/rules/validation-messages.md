# Validation Messages: Website Jurusan R&K

## Prinsip
Pesan validasi WAJIB Bahasa Indonesia, ramah, dan informatif. Hindari pesan teknis bawaan Laravel English.

---

## 1. Setup Global Translation

### Install Indonesia Lang
```bash
composer require laravel-lang/lang --dev
php artisan lang:add id
```

Atau download manual ke `lang/id/`.

### `lang/id/validation.php`
Sudah include semua pesan default. Override yang perlu:

```php
return [
    'required' => 'Kolom :attribute wajib diisi.',
    'email'    => 'Format :attribute tidak valid.',
    'max'      => [
        'string' => ':attribute maksimal :max karakter.',
        'file'   => 'Ukuran :attribute maksimal :max KB.',
    ],
    'attributes' => [
        'judul'   => 'judul berita',
        'gambar'  => 'gambar',
        'email'   => 'email',
    ],
];
```

---

## 2. Per Form Request

Untuk pesan SPESIFIK, override di Form Request:

```php
public function messages(): array
{
    return [
        'judul.required' => 'Judul berita wajib diisi.',
        'judul.max'      => 'Judul maksimal 255 karakter.',
        'gambar.image'   => 'File harus berupa gambar (JPG, PNG, atau WebP).',
        'gambar.max'     => 'Ukuran gambar maksimal 2MB.',
    ];
}

public function attributes(): array
{
    return [
        'judul'  => 'judul',
        'gambar' => 'gambar utama',
    ];
}
```

---

## 3. Tone & Style

### ✅ Ramah & Informatif
- "Format email tidak valid. Contoh: nama@email.com"
- "Password minimal 8 karakter."
- "Pilih minimal satu kategori."
- "Tanggal harus setelah hari ini."

### ❌ Hindari
- "The email field must be a valid email address." (English)
- "Error: invalid input." (terlalu teknis)
- "WAJIB DIISI!!!" (capitalisasi berlebihan, kasar)

### Tone Guideline
- Pakai "Anda" bukan "kamu" (formal — website kampus)
- Hindari ALL CAPS kecuali untuk highlight singkat
- Hindari emoji di pesan error
- Bicara langsung ke user (subject "Anda")

---

## 4. Pesan Sukses

### Format
```php
return redirect()->route('admin.berita.index')
    ->with('success', 'Berita berhasil ditambahkan.');
```

### Standar
| Aksi | Pesan |
|------|-------|
| Create | "[Modul] berhasil ditambahkan." |
| Update | "[Modul] berhasil diperbarui." |
| Delete | "[Modul] berhasil dihapus." |
| Restore | "[Modul] berhasil dipulihkan." |
| Upload | "File berhasil diunggah." |

Contoh: "Berita berhasil ditambahkan.", "Pesan kontak berhasil dikirim."

---

## 5. Pesan Error Umum

### HTTP Errors (custom error pages)
- 404: "Halaman tidak ditemukan."
- 403: "Anda tidak memiliki akses ke halaman ini."
- 500: "Terjadi kesalahan server. Silakan coba lagi atau hubungi admin."
- 419 (CSRF expired): "Sesi Anda telah berakhir. Silakan refresh halaman."

### Form Errors Generic
- "Mohon periksa data yang Anda masukkan."
- "Terjadi kesalahan. Silakan coba lagi."

---

## 6. Display di Blade

### Per-Field Error
```blade
<input type="text" name="judul" 
       class="form-control @error('judul') is-invalid @enderror">
@error('judul')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
```

### Flash Messages
```blade
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
```

### SweetAlert2 Toast (Admin)
```blade
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: @json(session('success')),
        showConfirmButton: false,
        timer: 3000,
    });
</script>
@endif
```

---

## 7. Konfirmasi Hapus (SweetAlert2)

```javascript
Swal.fire({
    title: 'Hapus data ini?',
    text: 'Data yang dihapus tidak dapat dikembalikan.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, Hapus',
    cancelButtonText: 'Batal',
    confirmButtonColor: '#e55353',
}).then((result) => {
    if (result.isConfirmed) {
        // submit DELETE request
    }
});
```

---

## 8. Larangan

- ❌ JANGAN pakai `alert()` JavaScript native (UX buruk)
- ❌ JANGAN pakai `console.log()` untuk debug di production
- ❌ JANGAN expose detail error ke user (stack trace, query SQL)
- ❌ JANGAN pakai pesan teknis: "DB connection failed", "QueryException", dst
