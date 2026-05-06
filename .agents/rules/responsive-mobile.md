# Responsive & Mobile: Website Jurusan R&K

## Prinsip
Mayoritas mahasiswa & calon mahasiswa akses dari **HP**. Website WAJIB tampil sempurna di mobile, BUKAN sekadar "tidak rusak".

**Approach: Mobile-First** — design dasar untuk mobile, escalate ke desktop dengan media query.

---

## 1. Bootstrap 5 Breakpoints

### Standar Breakpoint
| Class Prefix | Min Width | Device Target |
|--------------|-----------|---------------|
| `(none)` | 0 px | Mobile portrait (default) |
| `sm-` | ≥ 576 px | Mobile landscape |
| `md-` | ≥ 768 px | Tablet portrait |
| `lg-` | ≥ 992 px | Tablet landscape / small laptop |
| `xl-` | ≥ 1200 px | Desktop |
| `xxl-` | ≥ 1400 px | Large desktop |

### Custom Media Query (di custom.css)
```css
/* Mobile-first — default tanpa media query */
.card {
    padding: 1rem;
}

/* Tablet & up */
@media (min-width: 768px) {
    .card {
        padding: 1.5rem;
    }
}

/* Desktop & up */
@media (min-width: 992px) {
    .card {
        padding: 2rem;
    }
}
```

### Anti-Pattern
```css
/* ❌ JANGAN — desktop-first (sulit di-override mobile) */
.card { padding: 2rem; }
@media (max-width: 768px) {
    .card { padding: 1rem; }
}
```

---

## 2. Viewport Meta Tag (WAJIB)

Cek `resources/views/layouts/frontend.blade.php` & `admin.blade.php`:
```html
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
```

JANGAN pakai `user-scalable=no` (block zoom — buruk untuk a11y).

---

## 3. Touch Target Sizes (WCAG)

Tombol & link minimal **44x44px** di mobile.

```css
/* Button kecil tetap punya hit area cukup */
.btn-sm {
    min-height: 44px;
    min-width: 44px;
}

/* Link dalam menu / card */
.nav-link {
    padding: 0.75rem 1rem;  /* lebih besar di mobile */
}
```

### Anti-Pattern
```html
<!-- ❌ Icon button terlalu kecil -->
<button class="btn btn-sm" style="padding: 2px;">
    <i class="bi bi-x"></i>
</button>

<!-- ✅ BENAR -->
<button class="btn btn-sm" style="min-width: 44px; min-height: 44px;">
    <i class="bi bi-x"></i>
</button>
```

---

## 4. Typography Mobile

### Min 16px untuk Body Text
iOS Safari otomatis zoom kalau input < 16px. Hindari ini:

```css
body {
    font-size: 16px;        /* default */
}

input, textarea, select {
    font-size: 16px;        /* ← cegah auto-zoom iOS */
}

/* Heading bisa lebih kecil di mobile */
h1 { font-size: 1.75rem; }   /* 28px mobile */
@media (min-width: 768px) {
    h1 { font-size: 2.5rem; } /* 40px desktop */
}
```

### Line Height
- Body: `1.6` (lebih ruang nafas di mobile)
- Heading: `1.2-1.3`

---

## 5. Responsive Images

### Wajib `loading="lazy"` & `img-fluid`
```blade
<img src="{{ asset('storage/'.$berita->gambar) }}"
     alt="{{ $berita->judul }}"
     loading="lazy"
     class="img-fluid">
```

### Aspect Ratio (Cegah Layout Shift)
```css
.card-img-top {
    aspect-ratio: 16 / 9;
    object-fit: cover;
}
```

### `srcset` untuk Hero (Bonus)
```html
<img src="hero-800.jpg"
     srcset="hero-400.jpg 400w,
             hero-800.jpg 800w,
             hero-1600.jpg 1600w"
     sizes="(max-width: 768px) 100vw, 50vw"
     alt="Hero">
```

---

## 6. Navigation Mobile

### Hamburger Menu (Bootstrap Default)
Bootstrap 5 sudah punya. Pastikan struktur:
```html
<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="...">Beranda</a></li>
        </ul>
    </div>
</nav>
```

### Dropdown Mobile
- Gunakan `dropdown-menu-end` di mobile agar tidak overflow
- Auto-close setelah klik item (Bootstrap default)
- Test: dropdown harus bisa di-tap (bukan hanya hover)

### Sticky Navbar
```css
.navbar {
    position: sticky;
    top: 0;
    z-index: 1030;
}
```

---

## 7. Form UX Mobile

### Input Types Spesifik
```html
<!-- Email — keyboard otomatis @ -->
<input type="email" autocomplete="email" inputmode="email">

<!-- Telepon — keyboard numerik -->
<input type="tel" autocomplete="tel" inputmode="tel">

<!-- Angka -->
<input type="number" inputmode="numeric" pattern="[0-9]*">

<!-- URL -->
<input type="url" autocomplete="url" inputmode="url">

<!-- Date — date picker native -->
<input type="date">

<!-- Search -->
<input type="search" inputmode="search">
```

### Autocomplete
```html
<input type="text" name="nama" autocomplete="name">
<input type="email" name="email" autocomplete="email">
<input type="tel" name="telepon" autocomplete="tel">
```

### Form Layout
- Stack vertical di mobile (default Bootstrap)
- Label di atas input (bukan side-by-side)
- Tombol full-width: `<button class="btn btn-primary w-100 w-md-auto">`

---

## 8. Hover Alternatif

`:hover` TIDAK bekerja di touch device. Selalu sertakan `:focus-visible`:

```css
/* ❌ Mobile user tidak bisa trigger ini */
.card:hover {
    transform: translateY(-4px);
}

/* ✅ BENAR */
.card:hover,
.card:focus-visible {
    transform: translateY(-4px);
}

/* Atau pakai @media (hover: hover) */
@media (hover: hover) {
    .card:hover {
        transform: translateY(-4px);
    }
}
```

---

## 9. Hide/Show Pattern

### Bootstrap Display Utilities
```html
<!-- Tampilkan hanya di mobile -->
<div class="d-block d-md-none">Mobile only</div>

<!-- Tampilkan hanya di desktop -->
<div class="d-none d-md-block">Desktop only</div>

<!-- Tampilkan di tablet & desktop -->
<div class="d-none d-md-block d-lg-block">Tablet+</div>
```

### Common Use Case
```blade
{{-- Tombol "Tambah" full label di desktop, icon-only di mobile --}}
<a href="..." class="btn btn-primary">
    <i class="bi bi-plus"></i>
    <span class="d-none d-md-inline">Tambah Berita</span>
</a>
```

---

## 10. Avoid Horizontal Scroll

### Body Wrapper
```css
body {
    overflow-x: hidden;     /* prevent horizontal scroll */
}

.container,
.container-fluid {
    max-width: 100%;
    overflow-x: hidden;
}
```

### Tabel Responsif
```html
<div class="table-responsive">  <!-- ← wrap tabel besar -->
    <table class="table">
        ...
    </table>
</div>
```

### Image Tidak Boleh Overflow
```css
img {
    max-width: 100%;
    height: auto;
}
```

---

## 11. Grid Responsive

### Pattern Umum
```html
<!-- 1 kolom mobile, 2 tablet, 3 desktop -->
<div class="row g-3">
    <div class="col-12 col-md-6 col-lg-4">Card 1</div>
    <div class="col-12 col-md-6 col-lg-4">Card 2</div>
    <div class="col-12 col-md-6 col-lg-4">Card 3</div>
</div>
```

### Konten Utama + Sidebar
```html
<!-- Mobile: stack. Desktop: 8+4. -->
<div class="row">
    <div class="col-lg-8">Konten Utama</div>
    <div class="col-lg-4">Sidebar Artikel</div>
</div>
```

### Gap Spacing
```html
<!-- g-3: gap horizontal+vertical -->
<div class="row g-3">

<!-- gy-3: gap vertikal saja (untuk stack mobile) -->
<div class="row gy-3">
```

---

## 12. Performance Mobile

### Critical
- Image lazy load WAJIB (`loading="lazy"`)
- Defer non-critical JS: `<script defer src="...">`
- Critical CSS inline di `<head>` (untuk hero)
- Minify CSS/JS di production (Vite handle)

### Network
- Mayoritas user 4G — target halaman <500 KB total
- Lighthouse mobile score: target >85

---

## 13. Testing Breakpoints (WAJIB)

Test di Chrome DevTools (Ctrl+Shift+M) device sizes:

| Device | Width | Test Untuk |
|--------|-------|-----------|
| iPhone SE | **375 px** | Smallest mobile common |
| iPhone 14 | 390 px | Mobile standard |
| iPad Mini | **768 px** | Tablet portrait |
| iPad | 820 px | Tablet |
| Laptop | **1024 px** | Small desktop |
| Desktop | **1440 px** | Common desktop |

### Checklist per Breakpoint
- [ ] Tidak ada horizontal scroll
- [ ] Semua text readable (min 14px)
- [ ] Tombol bisa di-tap (min 44x44px)
- [ ] Image proporsional (no overflow / squashed)
- [ ] Form input tidak terlalu sempit
- [ ] Navbar collapse ke hamburger di <992 px
- [ ] Tabel tidak overflow (pakai `table-responsive`)

---

## 14. Eterna Template Quirks

### Hero Carousel
- Tinggi hero default terlalu besar di mobile — perlu override:
```css
@media (max-width: 768px) {
    #hero .carousel-item {
        min-height: 320px;        /* default 100vh terlalu tinggi */
    }
}
```

### Section Padding
Eterna pakai `.section { padding: 80px 0 }` di desktop. Reduce di mobile:
```css
@media (max-width: 768px) {
    .section {
        padding: 40px 0;
    }
}
```

### Topbar Email/Telepon
Topbar Eterna potensi overflow di <380px. Hide di mobile:
```css
@media (max-width: 575px) {
    .topbar .topbar-info {
        display: none;
    }
}
```

### `.navmenu` Mobile — JANGAN Override Aggressive
Eterna's mobile menu di `<1200px` punya specific layout:
```css
.navmenu a {
    display: flex;                    /* Eterna default */
    justify-content: space-between;   /* text kiri, icon kanan */
}
```

❌ **JANGAN** override `display: inline-flex` atau `display: block` di `.navmenu a` mobile — bikin click area sempit + layout broken.

✅ **BENAR**: Tambah padding atau ganti dengan **Bootstrap Offcanvas** untuk mobile drawer modern (lihat case study di `performance-css.md`).

### Mobile Menu Pattern Modern — Bootstrap Offcanvas
Untuk mobile menu yang lebih baik dari Eterna's overlay default:
```html
<!-- Trigger -->
<button data-bs-toggle="offcanvas" data-bs-target="#mobileDrawer">
    <i class="bi bi-list"></i>
</button>

<!-- Offcanvas drawer -->
<div class="offcanvas offcanvas-start" id="mobileDrawer">
    <div class="offcanvas-header">...</div>
    <div class="offcanvas-body">
        <ul>
            <li><button data-bs-toggle="collapse" data-bs-target="#sub1">...</button>
                <ul class="collapse" id="sub1">...</ul>
            </li>
        </ul>
    </div>
</div>
```

**Pros**: Native a11y (focus trap, escape, ARIA), battle-tested, side drawer pattern modern.

**Animation Caveats** (lihat `performance-css.md` untuk detail):
- Animate hanya `transform` & `opacity`, JANGAN `padding-left` / `box-shadow`
- Backdrop pakai solid color, JANGAN `backdrop-filter: blur` (lag di HP)
- Inner content JANGAN fade-in (cause "blank putih flash" saat first open)
- Wrap hover effects di `@media (hover: hover)` (avoid sticky hover di touch)

---

## 15. Larangan

- ❌ JANGAN `user-scalable=no` di viewport (block zoom = a11y violation)
- ❌ JANGAN `font-size < 14px` untuk body text
- ❌ JANGAN button/link < 44x44px tanpa padding extender
- ❌ JANGAN hover-only interaction (tidak bekerja di touch)
- ❌ JANGAN fixed width yang lebih besar dari viewport mobile (375px)
- ❌ JANGAN auto-play video dengan suara
- ❌ JANGAN modal yang tidak bisa di-close di mobile
- ❌ JANGAN tabel yang tidak di-wrap `.table-responsive`

---

## 16. Tools Audit Mobile

```bash
# Lighthouse — Chrome DevTools
# 1. Open DevTools (F12)
# 2. Tab Lighthouse
# 3. Pilih "Mobile" di Device
# 4. Pilih kategori: Performance, Accessibility, SEO
# 5. Generate Report
# Target score: Performance >85, A11y >90, SEO >90
```

```bash
# Manual responsive test (di .agents/workflows/verify-feature.md)
# Toggle Device Toolbar (Ctrl+Shift+M) → test 375, 768, 1024, 1440
```

### Online Tools
- https://www.responsivedesignchecker.com — preview multi-device
- https://search.google.com/test/mobile-friendly — Google Mobile-Friendly Test
- https://pagespeed.web.dev — Core Web Vitals
