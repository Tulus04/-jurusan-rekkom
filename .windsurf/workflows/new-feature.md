---
description: Bangun fitur baru Laravel sesuai standar proyek (Migration → Controller → Views → Verifikasi)
---

# Workflow: Fitur Baru Laravel

## FASE 1 — RISET
1. Pahami kebutuhan fitur dari user
2. Cek Model & Migration yang terlibat
3. Cek Controller & Route yang sudah ada
4. **Cek apakah fitur ini ada di proyek lama** (`C:\Users\riki\Documents\PBL_Jurusan_R&K\jurusanpolitani-main`)
   → Jika ada, pelajari implementasinya sebagai referensi
5. Cari library pendukung via Context7 MCP (jika perlu)
6. Buat implementation plan jika kompleks

## FASE 2 — BACKEND
7. Buat Migration: `php artisan make:migration create_{nama}_table`
// turbo
8. Buat/update Model + relationships + `$fillable`
9. Buat Form Request: `php artisan make:request Store{Nama}Request`
// turbo
10. Buat Controller CRUD: `php artisan make:controller Admin/{Nama}Controller --resource`
// turbo
11. Buat Controller Frontend: `php artisan make:controller Frontend/{Nama}Controller`
// turbo
12. Tambahkan Route di `routes/web.php`:
    ```php
    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('{nama}', Admin\{Nama}Controller::class);
    });
    Route::get('/{nama}', [Frontend\{Nama}Controller::class, 'index'])->name('{nama}.index');
    ```
13. Catat activity log setelah mutasi data (create/update/delete) — pakai `spatie/laravel-activitylog`

## FASE 3 — UI (Blade + Bootstrap 5)
14. **Admin**: Buat views CRUD di `resources/views/admin/{nama}/` (`index`, `create`, `edit`)
15. **Admin**: Gunakan DataTables.js untuk tabel data (server-side via Yajra)
16. **Admin**: Gunakan SweetAlert2 untuk konfirmasi hapus dan toast
17. **Frontend**: Buat views di `resources/views/frontend/{nama}/` (extends `layouts.frontend`, ikuti pola Eterna)
18. Setiap halaman WAJIB punya breadcrumb

## FASE 4 — NAVIGASI
19. **Admin**: Tambahkan menu di `resources/views/components/admin/sidebar.blade.php`
20. **Frontend**: Update navbar jika perlu
21. Pastikan middleware `auth` aktif untuk admin routes

## FASE 5 — VERIFIKASI
// turbo
22. Jalankan `php vendor/laravel/pint/builds/pint app/Http/Controllers/Admin/{Nama}Controller.php` (Pint format)
// turbo
23. Jalankan `php artisan test` (pastikan tidak ada test yang rusak)
// turbo
24. Jalankan `php artisan route:list --path={nama}` — route benar
25. Test manual di browser: CRUD berfungsi
26. **Buka file `.agents/rules/akun-test.md`** untuk credential login testing
27. Screenshot hasil akhir
