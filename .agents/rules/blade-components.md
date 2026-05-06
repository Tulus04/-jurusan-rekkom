# Blade Components: Website Jurusan R&K

## Prinsip DRY untuk Blade
Pilih cara reuse yang tepat: **Component** > **Partial** > **Inline**.

---

## 1. Decision Tree

```
Apakah dipakai >2 tempat?
├── TIDAK → Inline di file Blade
└── YA
    ├── Butuh props/parameter? 
    │   ├── YA → Blade Component (<x-name>)
    │   └── TIDAK → Partial (@include)
    └── Butuh data dari DB di setiap render?
        └── View Composer
```

---

## 2. Blade Component (`<x-name>`)

### Kapan Pakai
- Reusable UI dengan props (button, card, badge, alert)
- Butuh slot content
- Butuh logic kecil di constructor

### Lokasi
```
resources/views/components/
├── frontend/
│   ├── card-berita.blade.php
│   ├── breadcrumb.blade.php
│   └── alert.blade.php
└── admin/
    ├── form-input.blade.php
    └── data-table.blade.php
```

### Contoh: Akreditasi Badge
```blade
{{-- resources/views/components/akreditasi-badge.blade.php --}}
@props(['akreditasi'])
<span class="badge bg-{{ $akreditasi->getAkreditasiBootstrapColor() }}">
    {{ $akreditasi->akreditasi }}
</span>
```

### Pemakaian
```blade
<x-akreditasi-badge :akreditasi="$prodi" />
```

---

## 3. Partial (`@include`)

### Kapan Pakai
- Section UI tetap (sidebar, footer, navbar)
- Tidak butuh props yang banyak
- Akses langsung ke variabel parent

### Lokasi
```
resources/views/components/
├── frontend/
│   ├── sidebar-artikel.blade.php   ← View Composer inject data
│   ├── footer.blade.php
│   └── navbar.blade.php
└── admin/
    ├── sidebar.blade.php
    ├── header.blade.php
    └── tinymce-init.blade.php
```

### Contoh
```blade
{{-- Halaman manapun --}}
@include('components.frontend.sidebar-artikel')
```

---

## 4. View Composer

### Kapan Pakai
- Data yang dibutuhkan banyak halaman (sidebar artikel, footer kontak)
- Hindari query duplikat di setiap controller

### Setup di `ViewComposerServiceProvider`
```php
View::composer('components.frontend.sidebar-artikel', function ($view) {
    $view->with('artikelTerkini', app(BeritaRepository::class)->getRecentForSidebar());
});
```

### Lihat
- `app/Providers/ViewComposerServiceProvider.php`
- `app/Repositories/BeritaRepository.php` (method `getRecentForSidebar`)

---

## 5. Layout Inheritance

### Master Layout
```blade
{{-- resources/views/layouts/frontend.blade.php --}}
<html>
<head>
    <title>@yield('title') - Jurusan R&K</title>
    @yield('meta')
    @stack('styles')
</head>
<body>
    @include('components.frontend.navbar')
    
    @yield('content')
    
    @include('components.frontend.footer')
    
    @stack('scripts')
</body>
</html>
```

### Halaman Anak
```blade
@extends('layouts.frontend')

@section('title', 'Tentang Jurusan')
@section('content')
    {{-- konten halaman --}}
@endsection

@push('scripts')
    <script>...</script>
@endpush
```

---

## 6. `@stack` vs `@yield`

### `@yield` — single content
```blade
{{-- Layout --}}
@yield('content')

{{-- Anak --}}
@section('content')
    isi sekali saja
@endsection
```

### `@stack` — accumulate dari banyak tempat
```blade
{{-- Layout --}}
@stack('scripts')

{{-- Anak A --}}
@push('scripts')
    <script src="a.js"></script>
@endpush

{{-- Partial yang di-include --}}
@push('scripts')
    <script src="b.js"></script>
@endpush

{{-- Hasil: kedua script ter-render --}}
```

---

## 6b. ⚠️ KONVENSI WAJIB di Proyek Ini — `styles` & `scripts` Slot

> **PENTING**: Aturan ini **non-negotiable** untuk setiap halaman frontend & admin yang
> ingin tambahkan CSS/JS per-halaman. Salah pilih = blok CSS/JS **tidak ter-render** di output.

### Layout proyek (saat ini)

`resources/views/layouts/frontend.blade.php` & `admin.blade.php` mendukung **DUAL pattern**
(backward compatible):
```blade
{{-- Di <head> --}}
@stack('styles')
@yield('styles')

{{-- Di akhir <body> --}}
@stack('scripts')
@yield('scripts')
```

### Pattern WAJIB di halaman (preferensi `@push`)

```blade
@extends('layouts.frontend')

{{-- ✅ STANDAR PROYEK — pakai @push/@endpush untuk styles/scripts tambahan --}}
@push('styles')
<style>
    .my-page-css { ... }
</style>
@endpush

@section('content')
    {{-- konten halaman --}}
@endsection

@push('scripts')
<script>
    (function () { /* ... */ })();
</script>
@endpush
```

### Kenapa `@push` (BUKAN `@section`) untuk styles & scripts?

1. **Multi-source friendly**: Partial/include juga bisa contribute (mis. komponen sidebar
   yang butuh CSS sendiri pakai `@push('styles')` di partial-nya — jalan otomatis).
2. **Tidak menimpa**: `@section('styles')` di halaman akan **menimpa** kalau ada partial
   pakai `@section` yang sama. `@push` selalu **akumulatif**.
3. **Konsisten** dengan halaman admin yang sudah pakai `@push` (mis. di seluruh CRUD admin).

### ❌ Anti-Pattern — Mismatch `@push` vs Layout `@yield` saja

```blade
{{-- ❌ SALAH: layout HANYA punya @yield('styles'), halaman pakai @push --}}
{{-- Layout tidak punya @stack, jadi blok ini DI-DROP, tidak ter-render --}}
@push('styles')
<style>...</style>
@endpush
```

**Cara hindari**:

1. **Cek layout dulu** sebelum nulis `@push` atau `@section`:
   ```bash
   grep -nE "@stack|@yield" resources/views/layouts/frontend.blade.php
   ```
2. Kalau layout cuma `@yield('styles')` → halaman wajib `@section('styles')...@endsection`.
3. Kalau layout punya `@stack('styles')` → boleh `@push` (rekomendasi) atau `@section`.
4. Kalau **bingung**: tambah `@stack('styles')` di layout di samping `@yield` (zero-risk,
   karena dual-support — pattern ini sudah di-set di `frontend.blade.php` & `admin.blade.php`).

### Verification — pastikan style/script ter-render

```bash
# 1. Buka halaman di browser, view-source
# 2. Cari kata kunci unik dari CSS/JS halaman
# 3. Kalau tidak ada di output HTML → kemungkinan mismatch @push vs @yield
```

### Auto-test cepat (PowerShell):
```powershell
$r = Invoke-WebRequest "http://localhost:8000/url-halaman" -UseBasicParsing
if ($r.Content -match 'class-css-unik-halaman-saya') { 'OK' } else { 'MISS — cek @push/@stack' }
```

---

## 7. Anti-Patterns

### ❌ JANGAN inline business logic di Blade
```blade
{{-- ❌ SALAH --}}
@php
    $beritas = \App\Models\Berita::where('is_published', true)->take(5)->get();
@endphp
@foreach($beritas as $b) ... @endforeach
```

```blade
{{-- ✅ BENAR — pakai View Composer atau pass dari Controller --}}
@foreach($artikelTerkini as $b) ... @endforeach
```

### ❌ JANGAN duplikasi UI
Kalau melihat code Blade yang sama di >2 tempat, refactor jadi component/partial.

### ❌ JANGAN nested @include terlalu dalam
Max 2 level. Kalau lebih, refactor structure-nya.

---

## 8. Naming Convention

| Type | Lokasi | Naming |
|------|--------|--------|
| Page | `views/frontend/` atau `views/admin/` | `kebab-case.blade.php` |
| Component | `views/components/` | `kebab-case.blade.php` |
| Partial | `views/components/{domain}/` | `kebab-case.blade.php` (prefix `_` opsional) |
| Layout | `views/layouts/` | `kebab-case.blade.php` |
