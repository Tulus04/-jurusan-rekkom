# Workflow: Fitur Baru Laravel

## FASE 1 — RISET
1. Pahami kebutuhan fitur dari user
2. Cek Model & Migration yang terlibat
3. Cek Controller & Route yang sudah ada
4. **Cek apakah fitur ini ada di proyek lama** (`jurusanpolitani-main`)
   → Jika ada, pelajari implementasinya sebagai referensi
5. Cari library pendukung via Context7 MCP
6. Buat implementation plan jika kompleks

## FASE 2 — BACKEND
7. Buat Migration: `php artisan make:migration create_{nama}_table`
8. Buat/update Model + relationships + `$fillable`
9. Buat Form Request: `php artisan make:request Store{Nama}Request`
10. Buat Controller CRUD: `php artisan make:controller Admin/{Nama}Controller --resource`
11. Buat Controller Frontend: `php artisan make:controller Frontend/{Nama}Controller`
12. Tambahkan Route di `routes/web.php`:
    ```php
    // Admin routes
    Route::middleware('auth')->prefix('admin')->group(function () {
        Route::resource('{nama}', Admin\{Nama}Controller::class);
    });
    
    // Frontend routes
    Route::get('/{nama}', [Frontend\{Nama}Controller::class, 'index']);
    ```
13. Catat activity log setelah mutasi data (create/update/delete)

## FASE 3 — UI (Blade + Bootstrap 5)
14. **Admin**: Buat views CRUD di `resources/views/admin/{nama}/`
    - `index.blade.php` — List + DataTable
    - `create.blade.php` — Form tambah
    - `edit.blade.php` — Form edit
    - Semua `@extends('layouts.admin')`
15. **Admin**: Gunakan DataTables.js untuk tabel data
16. **Admin**: Gunakan SweetAlert2 untuk konfirmasi hapus dan toast
17. **Frontend**: Buat views di `resources/views/frontend/`
    - `@extends('layouts.frontend')`
    - Ikuti pola Eterna (breadcrumb, sidebar artikel, card grid)
18. Setiap halaman WAJIB punya breadcrumb

## FASE 4 — NAVIGASI
19. **Admin**: Tambahkan menu di sidebar (`layouts/partials/admin/sidebar.blade.php`)
20. **Frontend**: Update navbar jika perlu (`layouts/partials/frontend/navbar.blade.php`)
21. Pastikan middleware `auth` aktif untuk admin routes

## FASE 5 — VERIFIKASI
22. Test di browser: CRUD berfungsi
23. Jalankan `php artisan test`
24. Jalankan `./vendor/bin/pint --test` (linter)
25. **Buka file `akun-test.md`** untuk cek credential yang benar
26. Screenshot hasil akhir
