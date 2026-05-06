# SEO & Meta Tags: Website Jurusan R&K

## Prinsip
Website jurusan **publik** wajib SEO-friendly agar mudah ditemukan via Google. Setiap halaman harus punya meta lengkap.

---

## 1. Meta Tags Wajib

### Setiap halaman publik
```blade
@extends('layouts.frontend')

@section('title', 'Tentang Jurusan')
@section('meta_description', 'Profil Jurusan Rekayasa Komputer Politeknik Pertanian Negeri Samarinda...')

@section('meta')
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="{{ asset($ogImage ?? 'frontend/img/og-default.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('meta_description')">
@endsection
```

### Layout Frontend (`layouts/frontend.blade.php`):
```blade
<head>
    <title>@yield('title') - Jurusan R&K Politani</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Jurusan Rekayasa Komputer Politeknik Pertanian Negeri Samarinda.')">
    @yield('meta')
</head>
```

---

## 2. Standar per Halaman

### Halaman Berita Detail
```blade
@section('title', $berita->judul)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($berita->ringkasan), 160))

@section('meta')
    @parent
    <meta property="og:image" content="{{ asset('storage/'.$berita->gambar) }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $berita->tanggal_publikasi->toIso8601String() }}">
@endsection
```

### Karakteristik Meta Description
- Panjang ideal: 120-160 karakter
- WAJIB `strip_tags()` jika dari rich text
- Hindari duplikasi antar halaman
- Mengandung keyword utama halaman

---

## 3. Slug & URL

### Slug Wajib
- Auto-generate dari judul saat **create**, JANGAN auto-update saat edit (broken link).
- Lock di model boot:

```php
protected static function booted(): void
{
    static::creating(function ($berita) {
        if (empty($berita->slug)) {
            $berita->slug = Str::slug($berita->judul);
        }
    });
}
```

### URL Pattern
```
✅ /berita/workshop-iot-bersama-telkom
✅ /profil/visi-misi
✅ /program-studi/teknologi-rekayasa-perangkat-lunak

❌ /berita/123
❌ /berita?id=123
❌ /Berita/Workshop-IOT (case-sensitive)
```

---

## 4. Heading Hierarchy

### 1 H1 per halaman
```html
<!-- ✅ BENAR -->
<main>
    <h1>Workshop IoT bersama Telkom</h1>  <!-- 1x -->
    <section>
        <h2>Materi Workshop</h2>            <!-- bisa banyak -->
        <h3>Hari 1: Pengenalan</h3>
    </section>
</main>

<!-- ❌ SALAH — multiple H1 -->
<h1>Workshop IoT</h1>
<h1>Materi</h1>
```

---

## 5. Image SEO

### Alt Text Wajib
```blade
{{-- ❌ SALAH --}}
<img src="{{ asset('storage/'.$berita->gambar) }}" alt="">
<img src="..." alt="image">

{{-- ✅ BENAR — descriptive --}}
<img src="..." alt="Mahasiswa TRPL mengikuti workshop IoT">
```

### File Naming
```
✅ workshop-iot-telkom-2026.jpg
❌ IMG_20260301_142315.jpg
❌ photo (1).jpg
```

---

## 6. Sitemap & Robots

### Wajib `public/robots.txt`
```
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /login

Sitemap: https://rekkom.politani.ac.id/sitemap.xml
```

### Sitemap Dinamis
Install: `composer require spatie/laravel-sitemap`

```php
// routes/web.php
Route::get('/sitemap.xml', function () {
    return Spatie\Sitemap\Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/profil/tentang-jurusan'))
        ->add(Berita::published()->get())
        ->toResponse(request());
});
```

---

## 7. Canonical URL

Cegah duplicate content:
```blade
<link rel="canonical" href="{{ url()->current() }}">
```

---

## 8. Schema.org JSON-LD (Bonus)

### Halaman Berita Detail
```blade
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "headline": "{{ $berita->judul }}",
    "image": "{{ asset('storage/'.$berita->gambar) }}",
    "datePublished": "{{ $berita->tanggal_publikasi->toIso8601String() }}",
    "author": {
        "@type": "Organization",
        "name": "Jurusan Rekayasa Komputer Politani"
    }
}
</script>
```

---

## 9. SEO Performance

- Page speed: target <3 detik (Lighthouse)
- Mobile-friendly: WAJIB responsive (Bootstrap 5 sudah handle)
- HTTPS: wajib di production
- Lazy loading gambar: lihat `performance.md`

---

## 10. Tools Verifikasi

- Google Search Console — submit sitemap
- Lighthouse (Chrome DevTools) — audit SEO score (target >90)
- Meta Tags Preview: https://metatags.io
- OpenGraph Preview: https://www.opengraph.xyz
