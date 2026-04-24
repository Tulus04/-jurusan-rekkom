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
- [ ] Cek responsif: resize browser
- [ ] Cek breadcrumb muncul

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
