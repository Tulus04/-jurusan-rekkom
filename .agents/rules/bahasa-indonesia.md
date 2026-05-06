# Bahasa Indonesia: Website Jurusan R&K

## Prinsip
Website ini untuk **Politeknik Pertanian Negeri Samarinda** (Indonesia). Seluruh teks user-facing WAJIB Bahasa Indonesia.

---

## 1. Konfigurasi Laravel

### `config/app.php`
```php
'locale' => 'id',
'fallback_locale' => 'en',
'timezone' => 'Asia/Jakarta',
```

### Install Translation Indonesia
```bash
composer require laravel-lang/common --dev
php artisan lang:add id
```

Atau manual: download dari https://github.com/Laravel-Lang/lang ke `lang/id/`.

---

## 2. Format Tanggal

### Wajib pakai `translatedFormat()` (bukan `format()`)

```blade
{{-- ❌ SALAH — bulan English --}}
{{ $berita->tanggal_publikasi->format('d F Y') }}
{{-- "1 May 2026" --}}

{{-- ✅ BENAR --}}
{{ $berita->tanggal_publikasi->translatedFormat('d F Y') }}
{{-- "1 Mei 2026" --}}
```

### Format Standar
| Konteks | Format | Contoh |
|---------|--------|--------|
| Tanggal panjang | `d F Y` | `1 Mei 2026` |
| Tanggal pendek | `d M Y` | `1 Mei 2026` |
| Dengan jam | `d F Y, H:i` | `1 Mei 2026, 14:30` |
| Hari | `l, d F Y` | `Jumat, 1 Mei 2026` |
| Diff (relative) | `->diffForHumans()` | `2 hari lalu` |

### Diff Indonesia
```php
\Carbon\Carbon::setLocale('id');
$berita->created_at->diffForHumans(); // "2 hari yang lalu"
```

Set di `AppServiceProvider::boot()`:
```php
\Carbon\Carbon::setLocale(config('app.locale'));
```

---

## 3. Format Angka & Uang

### Currency Rupiah
```php
// ✅ BENAR
'Rp '.number_format(1500000, 0, ',', '.')
// "Rp 1.500.000"

// ❌ SALAH
'Rp '.number_format(1500000)
// "Rp 1,500,000" (English style)
```

### Helper di `app/Helpers/format.php`:
```php
function rupiah(int $value): string
{
    return 'Rp '.number_format($value, 0, ',', '.');
}
```

---

## 4. Field Labels & UI Text

### Wajib Bahasa Indonesia
```blade
{{-- ✅ BENAR --}}
<label for="judul">Judul Berita</label>
<button>Simpan</button>
<button>Batal</button>
<button>Hapus</button>
<button>Tambah Berita</button>

{{-- ❌ SALAH --}}
<label for="title">News Title</label>
<button>Save</button>
<button>Cancel</button>
```

### Standar Tombol
| Inggris | Indonesia |
|---------|-----------|
| Save | Simpan |
| Cancel | Batal |
| Delete | Hapus |
| Edit | Ubah / Edit |
| Submit | Kirim |
| Login | Masuk |
| Logout | Keluar |
| Search | Cari |
| Filter | Saring / Filter |
| Add New | Tambah |
| View | Lihat |
| Download | Unduh |
| Upload | Unggah |
| Confirm | Konfirmasi |
| Yes / No | Ya / Tidak |

### Standar Pesan
- Sukses: "Data berhasil disimpan."
- Error: "Terjadi kesalahan. Silakan coba lagi."
- Konfirmasi hapus: "Apakah Anda yakin ingin menghapus data ini?"
- Empty state: "Belum ada data."
- Loading: "Memuat..."

---

## 5. Validation Messages

Di Form Request, pesan custom Bahasa Indonesia:

```php
public function messages(): array
{
    return [
        'judul.required'  => 'Judul wajib diisi.',
        'judul.max'       => 'Judul maksimal 255 karakter.',
        'email.email'     => 'Format email tidak valid.',
        'gambar.image'    => 'File harus berupa gambar.',
        'gambar.max'      => 'Ukuran gambar maksimal 2MB.',
    ];
}
```

Atau global di `lang/id/validation.php`.

---

## 6. URL Slugs

URL pakai slug Indonesia (tanpa karakter khusus):
```
✅ /berita/workshop-iot-bersama-telkom
❌ /news/workshop-iot-with-telkom
```

```php
'slug' => Str::slug($this->judul); // otomatis Indonesia-friendly
```

---

## 7. Database Field Names

Field name database Bahasa Indonesia:
```
✅ judul, ringkasan, konten, penulis_id, tanggal_publikasi, is_published
❌ title, summary, content, author_id, published_at, status
```

Tetapi **timestamps** Laravel pakai default English (`created_at`, `updated_at`, `deleted_at`).

---

## 8. Eksepsi (TIDAK perlu Indonesia)

Tetap pakai English:
- Code (variable, function, class names)
- Comments (boleh Indonesia, lebih baik English untuk team international)
- Git commit messages
- Error log (Laravel default)
- Console output (artisan command)
