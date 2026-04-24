# Workflow: Verifikasi Fitur

## Langkah Verifikasi

### 1. Pastikan Dev Server Aktif
```bash
php artisan serve
npm run dev
```

### 2. Buka Credential
Buka file `.agents/rules/akun-test.md` dan gunakan credential yang benar.

### 3. Login ke Admin
- URL: http://localhost:8000/login
- Gunakan credential dari `akun-test.md`

### 4. Verifikasi Visual

#### Admin Panel:
- [ ] CoreUI layout tampil benar (sidebar, header)
- [ ] Sidebar menu menampilkan semua modul
- [ ] Breadcrumb muncul di setiap halaman
- [ ] DataTable berfungsi (search, sort, pagination)
- [ ] Form create/edit berfungsi
- [ ] Tombol hapus memunculkan SweetAlert2
- [ ] Toast notification muncul setelah aksi

#### Frontend:
- [ ] Topbar info (email, telepon) muncul
- [ ] Navbar dengan dropdown berfungsi
- [ ] Hero carousel bergerak
- [ ] Breadcrumb muncul di setiap halaman
- [ ] Sidebar "Artikel Terkini" muncul (di halaman konten)
- [ ] Footer 4-kolom tampil
- [ ] Tombol "Back to Top" berfungsi

### 5. Verifikasi CRUD (Per Modul)
Untuk setiap modul yang baru dibuat:
- [ ] **Create**: Tambah data baru → berhasil disimpan
- [ ] **Read**: Data tampil di list/index
- [ ] **Update**: Edit data → perubahan tersimpan
- [ ] **Delete**: Hapus data → SweetAlert muncul → data terhapus
- [ ] **Frontend**: Data tampil di halaman publik

### 6. Verifikasi Responsif
- [ ] Resize browser ke ukuran mobile (375px)
- [ ] Navbar collapse ke hamburger menu
- [ ] Konten tidak overflow
- [ ] Tabel responsif (horizontal scroll)

### 7. Screenshot Hasil
Ambil screenshot untuk dokumentasi:
- Admin dashboard
- Admin CRUD (index, create)
- Frontend homepage
- Frontend detail page
