---
description: Verifikasi fitur setelah selesai dibangun (Pint, Test, Route, Visual)
---

# Workflow: Verifikasi Fitur

## 1. Pastikan Dev Server Aktif
// turbo
```powershell
# Cek apakah port 8000 sudah listening
netstat -ano | findstr ":8000"
# Jika belum, jalankan:
php artisan serve
```

## 2. Code Quality Checks (WAJIB)
// turbo
```powershell
# Pint — format PHP PSR-12
php vendor/laravel/pint/builds/pint --test

# Jika ada issue, auto-fix:
php vendor/laravel/pint/builds/pint
```

// turbo
```powershell
# Test
php artisan test

# Route check
php artisan route:list --compact
```

## 3. Buka Credential
Buka file `.agents/rules/akun-test.md` dan gunakan credential yang benar.
- Email: `admin@rekkom.ac.id`
- Password: `password`

## 4. Login & Verifikasi Visual

### Admin Panel:
- [ ] CoreUI layout tampil benar (sidebar, header)
- [ ] Sidebar menu menampilkan modul baru
- [ ] Breadcrumb muncul di setiap halaman
- [ ] DataTable berfungsi (search, sort, pagination)
- [ ] Form create/edit berfungsi
- [ ] Tombol hapus memunculkan SweetAlert2
- [ ] Toast notification muncul setelah aksi

### Frontend:
- [ ] Topbar info (email, telepon) muncul
- [ ] Navbar dengan dropdown berfungsi
- [ ] Breadcrumb muncul di setiap halaman
- [ ] Sidebar "Artikel Terkini" muncul (di halaman konten)
- [ ] Footer 4-kolom tampil
- [ ] Tombol "Back to Top" berfungsi

## 5. Verifikasi CRUD (Per Modul)
- [ ] **Create**: Tambah data baru → berhasil disimpan
- [ ] **Read**: Data tampil di list/index
- [ ] **Update**: Edit data → perubahan tersimpan
- [ ] **Delete**: Hapus data → SweetAlert muncul → data terhapus
- [ ] **Frontend**: Data tampil di halaman publik

## 6. Verifikasi Responsif
- [ ] Resize browser ke ukuran mobile (375px)
- [ ] Navbar collapse ke hamburger menu
- [ ] Konten tidak overflow
- [ ] Tabel responsif (horizontal scroll)

## 7. Activity Log Check
// turbo
```powershell
php artisan tinker --execute="echo Spatie\Activitylog\Models\Activity::latest()->first()?->description;"
```
