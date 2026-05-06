# Performance: Website Jurusan R&K

## 1. N+1 Query Prevention

### Wajib Eager Loading
SELALU pakai `with()` saat query collection yang akan akses relasi di view/loop.

```php
// ❌ SALAH — N+1 (1 query untuk berita + N query untuk penulis + N query untuk kategoris)
$beritas = Berita::published()->get();
foreach ($beritas as $berita) {
    echo $berita->penulis->name;     // query baru
    echo $berita->kategoris->first(); // query baru
}

// ✅ BENAR
$beritas = Berita::with(['penulis:id,name', 'kategoris:id,nama'])
    ->published()
    ->get();
```

### Select Spesifik
Untuk DataTables atau halaman list, pilih kolom yang dibutuhkan saja.

```php
// ❌ SALAH — load semua kolom termasuk konten panjang
Berita::all();

// ✅ BENAR
Berita::select(['id', 'judul', 'slug', 'gambar', 'tanggal_publikasi'])->get();
```

## 2. Caching Strategi

### Data Statis (jarang berubah)
Cache data konfigurasi seperti kontak jurusan, slider home, info jurusan.

```php
$kontak = cache()->remember('kontak.jurusan', now()->addHours(24), function () {
    return Kontak::first();
});
```

### Cache Invalidation
Kalau admin update via CRUD, WAJIB invalidate cache:
```php
// Setelah update
cache()->forget('kontak.jurusan');
```

### Apa yang TIDAK boleh di-cache
- Data user-specific (sesi, kontak masuk)
- Data realtime (notifikasi, log activity)
- Data yang sering berubah (>10x/hari)

## 3. Image Optimization

### Wajib `loading="lazy"`
Semua `<img>` di halaman konten WAJIB pakai lazy loading kecuali above-the-fold (hero).

```html
<img src="{{ asset('storage/'.$berita->gambar) }}"
     alt="{{ $berita->judul }}"
     loading="lazy"
     class="img-fluid">
```

### Resize via Intervention Image
Upload gambar besar WAJIB di-resize di server (max 1600px width) — lihat `TinymceImageController` sebagai referensi.

### Format
- Foto → WebP atau JPEG quality 85
- Icon → SVG atau PNG transparent
- Animation → GIF (jangan resize, akan rusak)

## 4. Pagination Wajib

JANGAN pernah `->get()` untuk halaman publik dengan data >20 row.

```php
// ✅ BENAR
$beritas = Berita::paginate(12);
$beritas = Berita::cursorPaginate(12); // lebih cepat untuk dataset besar
```

Pagination links HARUS `withQueryString()` agar filter/search tetap aktif:
```php
$beritas->withQueryString();
```

## 5. Database Query

### Index Wajib
- Foreign key — auto-indexed via `constrained()`
- Kolom search — tambah `$table->index('judul')` di migration
- Kolom unique — `$table->unique('slug')`

### JANGAN raw query
Selalu via Eloquent atau Query Builder dengan parameter binding.

## 6. Asset Loading

### CSS
- Critical CSS → inline di `<head>` (CSS hero, navbar)
- Non-critical → defer atau load di akhir body

### JavaScript
- `<script>` di akhir body atau `defer`
- JANGAN load jQuery di frontend (admin only)

### CDN vs Local
- Production: pakai local asset (lebih cepat, no privacy concern)
- Development: CDN OK untuk prototype

## 7. Tools Monitoring

```bash
# Debug query yang lambat
php artisan db:monitor

# Profile via Telescope (kalau install)
composer require laravel/telescope --dev

# Cek N+1 dengan Laravel Debugbar
composer require barryvdh/laravel-debugbar --dev
```

## 8. Production Checklist

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
npm run build  # BUKAN npm run dev
```
