# Skill: Gate Function — Verifikasi Sebelum Klaim

## Prinsip
**JANGAN PERNAH** bilang "sudah selesai" atau "sudah berfungsi" tanpa BUKTI NYATA.

---

## Checklist Verifikasi Wajib

### Setelah Membuat Migration
- [ ] Jalankan `php artisan migrate` — tidak ada error
- [ ] Cek database: tabel sudah terbuat dengan kolom yang benar
- [ ] Cek foreign key: relasi sudah benar

### Setelah Membuat Model
- [ ] Cek `$fillable` sudah lengkap
- [ ] Cek relasi (`hasMany`, `belongsTo`) sudah benar
- [ ] Test di Tinker: `App\Models\Blog::factory()->create()` (jika ada factory)

### Setelah Membuat Controller
- [ ] Cek route terdaftar: `php artisan route:list --compact`
- [ ] Test di browser: halaman bisa diakses
- [ ] Test CRUD: create, read, update, delete — semua berfungsi

### Setelah Membuat View
- [ ] Buka di browser — tidak ada error Blade
- [ ] Cek layout: extends master layout yang benar
- [ ] Cek breadcrumb muncul
- [ ] **Cek responsif di 4 breakpoint** (Chrome DevTools Ctrl+Shift+M):
  - [ ] **375 px** (iPhone SE) — tidak ada horizontal scroll, text readable
  - [ ] **768 px** (iPad) — layout transisi mulus, hamburger menu aktif
  - [ ] **1024 px** (laptop) — sidebar/grid muncul, navbar full
  - [ ] **1440 px** (desktop) — konten tidak terlalu lebar (max-width)
- [ ] **Touch target check**: tombol & link minimal 44x44 px di mobile
- [ ] **Form mobile UX**: input pakai `type` & `inputmode` yang sesuai (email/tel/numeric)
- [ ] **Image responsive**: pakai `class="img-fluid"` + `loading="lazy"`
- [ ] **Tabel responsive**: dibungkus `<div class="table-responsive">`
- [ ] **Hover alternatif**: `:hover` punya pasangan `:focus-visible` (touch user)

### Setelah Selesai Fitur
- [ ] Jalankan `php artisan test` — semua pass
- [ ] Jalankan `./vendor/bin/pint --test` — format rapi
- [ ] Jalankan `php artisan route:list` — tidak ada route error
- [ ] Screenshot hasil akhir (jika visual)

---

## Format Klaim yang Benar

### ❌ Salah:
> "Sudah saya buat CRUD berita."

### ✅ Benar:
> "CRUD berita sudah dibuat dan diverifikasi:
> - Migration berjalan sukses
> - Model Blog dengan relasi Category berfungsi
> - Admin CRUD (index/create/edit/delete) berfungsi di browser
> - Frontend list berita + detail berfungsi
> - `php artisan test` pass
> - Screenshot: [link]"
