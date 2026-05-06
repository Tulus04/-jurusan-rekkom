# Asset Management: Website Jurusan R&K

## Prinsip
Aset (gambar, dokumen, file) harus tertata, ter-optimize, dan tidak menumpuk orphan file.

---

## 1. Lokasi Penyimpanan

### Wajib di `storage/app/public/`
JANGAN simpan file upload di `public/` langsung — security risk.

```
storage/app/public/
├── berita/
│   ├── {filename}.jpg          ← Gambar utama berita
│   └── inline/
│       └── {filename}.jpg      ← Gambar inline TinyMCE
├── kegiatan/
├── beasiswa/
├── pedoman/
│   └── {filename}.pdf
├── slider/
├── prodi/
└── pesan-kontak/               ← Lampiran (jika ada)
```

### Symlink Wajib (sekali setup)
```bash
php artisan storage:link
```
URL akses: `asset('storage/berita/foto.jpg')`

---

## 2. Naming Convention

### Pattern
```
{slug}-{random}.{ext}
```

### Contoh
```php
$filename = Str::slug(Str::limit($original, 40, '')).'-'.Str::random(8).'.'.$ext;
// "workshop-iot-bersama-telkom-aB12cD3e.jpg"
```

### Aturan
- ✅ slug dari nama asli (sanitasi otomatis)
- ✅ random suffix (cegah collision)
- ✅ extension lowercase
- ❌ JANGAN pakai timestamp `.now()` (rentan collision di concurrent upload)
- ❌ JANGAN pakai original filename mentah (XSS via filename)

---

## 3. Dimensi & Format Standar

### Gambar Hero / Slider
- Dimensi: 1920x800 px (atau aspect ratio 12:5)
- Format: JPEG quality 85 atau WebP
- Max size: 500 KB (after optimization)

### Card Berita / Kegiatan
- Dimensi: 800x500 px (aspect ratio 8:5)
- Format: WebP / JPEG quality 85
- Max size: 200 KB

### Avatar / Foto Pejabat
- Dimensi: 400x400 px (square)
- Format: WebP / PNG (kalau transparent)
- Max size: 100 KB

### Inline Image (TinyMCE)
- Auto-resize ke max 1600px width via Intervention Image
- Quality 85
- Lihat `TinymceImageController` sebagai referensi

### Document (PDF)
- Max size: 5 MB
- Format: PDF/A untuk arsip permanent

---

## 4. Format Berdasarkan Kasus

| Kasus | Format Wajib |
|-------|--------------|
| Foto / kompleks | WebP atau JPEG |
| Icon / logo | SVG (vector) |
| Image dengan transparency | PNG |
| Animasi | GIF (tanpa resize) |
| Hero (perlu loading cepat) | WebP + JPEG fallback |
| Dokumen | PDF |

---

## 5. Image Optimization Pipeline

### Saat Upload
```php
use Intervention\Image\Laravel\Facades\Image;

$image = Image::read($file)->scaleDown(width: 1600);
$encoded = $image->toJpeg(quality: 85);
Storage::disk('public')->put($path, (string) $encoded);
```

### Lazy Loading (Wajib di HTML)
```blade
<img src="{{ asset('storage/'.$berita->gambar) }}"
     alt="{{ $berita->judul }}"
     loading="lazy"
     class="img-fluid">
```

---

## 6. Cleanup Orphan File

### Saat Delete Model
```php
// BeritaController@destroy
if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
    Storage::disk('public')->delete($berita->gambar);
}
$berita->delete();
```

### Bulk Cleanup (Cron Job)
Buat artisan command yang scan file di storage vs reference di DB:

```bash
php artisan storage:cleanup-orphans
```

---

## 7. Asset Versioning (Production)

Untuk cache busting saat update CSS/JS:
```blade
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
{{-- Atau Vite: --}}
@vite(['resources/css/app.css'])
```

---

## 8. CDN vs Local

### Development
- CDN OK untuk Bootstrap, Bootstrap Icons (cepat setup)

### Production
- **Local serve** — lebih cepat, no privacy concern (GDPR-aware)
- Pakai Vite build output di `public/build/`

---

## 9. Larangan

- ❌ JANGAN simpan file `.exe`, `.bat`, `.sh`, `.php` di storage upload (security)
- ❌ JANGAN simpan file > 10 MB tanpa pertimbangan khusus
- ❌ JANGAN serve user-uploaded SVG mentah (XSS via embedded JS)
- ❌ JANGAN commit file `.env`, `storage/*.key`, atau folder `public/storage` ke Git
- ❌ JANGAN pakai original filename dari user (sanitasi via `Str::slug`)
