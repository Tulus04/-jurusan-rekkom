# Tech Stack: Website Jurusan R&K

## Core Stack

| Layer | Teknologi | Versi |
|-------|-----------|-------|
| **Backend** | Laravel | 12.x |
| **PHP** | PHP | 8.2+ |
| **Database** | MySQL | 8.x |
| **ORM** | Eloquent | (bawaan Laravel) |
| **Template Engine** | Blade | (bawaan Laravel) |
| **CSS Framework** | Bootstrap | 5.3 |
| **Icons** | Bootstrap Icons | Latest |
| **Auth** | Laravel Breeze | (simple auth) |
| **Build Tool** | Vite | (bawaan Laravel) |

## Frontend Publik
| Komponen | Teknologi |
|----------|-----------|
| Template | Eterna (BootstrapMade) |
| Layout | Bootstrap 5 Grid |
| Carousel | Bootstrap Carousel |
| Navbar | Bootstrap Navbar + Dropdown |
| Cards | Bootstrap Cards |

## Admin Panel
| Komponen | Teknologi |
|----------|-----------|
| Template | CoreUI Free |
| DataTables | Yajra DataTables + DataTables.js (jQuery) |
| WYSIWYG | **TinyMCE 7 Free** (jQuery-free, ganti Summernote) |
| Select | **Tom Select** (jQuery-free, ganti Select2) |
| Notifikasi | SweetAlert2 (jQuery-free) |
| Chart | Chart.js |
| Form | Bootstrap 5 Forms |
| jQuery | Hanya sebagai dependency DataTables.js |

## Packages Composer

| Package | Kegunaan |
|---------|----------|
| `laravel/breeze` | Authentication |
| `yajra/laravel-datatables-oracle` | Server-side DataTables |
| `intervention/image-laravel` | Image processing (upload + resize) |
| `spatie/laravel-activitylog` | Activity logging admin |

## Packages NPM

| Package | Kegunaan |
|---------|----------|
| `axios` | Latest | HTTP client | ✅ Wajib |
| `laravel-vite-plugin` | Latest | Vite integration | ✅ Wajib |
| `vite` | Latest | Build tool | ✅ Wajib |

## Admin Vendor Assets (di `public/admin/vendor/`)

> jQuery dan library dependennya di-load sebagai vendor assets HANYA di admin panel.
> TIDAK boleh digunakan di frontend.

| Library | Kegunaan | jQuery? |
|---------|----------|---------|
| jQuery | Dependency DataTables.js | - |
| DataTables.js | Tabel CRUD server-side | Ya |
| TinyMCE 7 Free | WYSIWYG editor | **Tidak** |
| Tom Select | Searchable select dropdown | **Tidak** |
| SweetAlert2 | Dialog konfirmasi hapus | **Tidak** |

## Yang TIDAK Digunakan:
- ❌ Tailwind CSS — diganti Bootstrap 5
- ❌ Alpine.js — tidak diperlukan
- ❌ Supabase — pakai MySQL langsung
- ❌ Next.js — ini Laravel (Blade)
- ❌ React/Vue — server-side rendering (Blade)
- ❌ jQuery di frontend — hanya di admin panel
