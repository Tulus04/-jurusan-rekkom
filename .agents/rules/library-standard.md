# Library Standard: Website Jurusan R&K

## Strategi Pemilihan Library

```
PRIORITAS:
1. Cari library via Context7 MCP (mcp_context7_resolve-library-id)
2. Jika ada library yang cocok → gunakan, pelajari docs via Context7
3. Jika TIDAK ada library → buat sendiri (custom)
4. JANGAN install library baru tanpa evaluasi dulu
```

## Library yang Sudah Disetujui

### Backend (Composer)

| Package | Versi | Kegunaan | Status |
|---------|-------|----------|--------|
| `laravel/framework` | ^12.0 | Core framework | ✅ Wajib |
| `laravel/breeze` | Latest | Auth scaffolding | ✅ Wajib |
| `yajra/laravel-datatables-oracle` | Latest | Server-side DataTables | ✅ Wajib |
| `intervention/image-laravel` | ^3.0 | Image processing | ✅ Wajib |
| `spatie/laravel-activitylog` | Latest | Activity logging | ✅ Wajib |

### Admin Vendor (di `public/admin/vendor/` — BUKAN via NPM)

| Library | Kegunaan | jQuery? | Status |
|---------|----------|---------|--------|
| jQuery | Dependency DataTables.js | - | ✅ Admin only |
| DataTables.js | Tabel CRUD server-side | Ya | ✅ Admin only |
| TinyMCE 7 Free | WYSIWYG editor (ganti Summernote) | **TIDAK** | ✅ Admin only |
| Tom Select | Searchable select (ganti Select2) | **TIDAK** | ✅ Admin only |
| SweetAlert2 | Dialog konfirmasi delete | **TIDAK** | ✅ Admin only |

### CDN (Boleh untuk Prototype, NPM untuk Production)

| Library | CDN URL | Kegunaan |
|---------|---------|----------|
| Google Maps Embed | iframe | Peta di halaman Kontak |
| Google Fonts | link | Font Eterna (Open Sans, Poppins, Raleway) |

## Library yang DILARANG

| Library | Alasan |
|---------|--------|
| Tailwind CSS | Konflik dengan Bootstrap 5 |
| jQuery di FRONTEND | Hanya diizinkan di admin panel |
| Summernote | Diganti TinyMCE 7 (lebih aktif, jQuery-free) |
| Select2 | Diganti Tom Select (lebih ringan, jQuery-free) |
| Vue.js / React | Proyek ini server-side (Blade) |
| Livewire | Over-engineering untuk CMS ini |
| Alpine.js | Tidak diperlukan |

## Proses Menambahkan Library Baru

1. **Evaluasi**: Apakah benar-benar dibutuhkan? Bisa pakai native Laravel?
2. **Cek Context7**: `mcp_context7_resolve-library-id` → cek docs
3. **Cek kompatibilitas**: Apakah support Laravel 12 & PHP 8.2+?
4. **Cek lisensi**: Pastikan MIT/Apache (open source)
5. **Install**: `composer require` atau `npm install`
6. **Dokumentasikan**: Update file ini dengan entry baru
