# Arsitektur Proyek: Website Jurusan R&K

## Overview
Proyek ini adalah **CMS monolith** berbasis Laravel untuk Website Jurusan Rekayasa dan Komputer, Politeknik Pertanian Negeri Samarinda.

## Arsitektur Utama: MVC + Repository Pattern

```
┌─────────────────────────────────────────────┐
│                    Routes                    │
│         (web.php, admin routes)             │
├─────────────────────────────────────────────┤
│                  Middleware                   │
│      (auth, guest, admin-only)              │
├─────────────────────────────────────────────┤
│                 Controllers                  │
│   Frontend (public) │ Admin (authenticated) │
├─────────────────────────────────────────────┤
│              Form Requests                   │
│         (validasi input user)               │
├─────────────────────────────────────────────┤
│               Repositories                   │
│         (abstraksi akses data)              │
├─────────────────────────────────────────────┤
│                  Models                      │
│            (Eloquent ORM)                   │
├─────────────────────────────────────────────┤
│                 Database                     │
│              (MySQL 8.x)                    │
└─────────────────────────────────────────────┘
```

## Dua Domain UI:

### 1. Frontend Publik (Eterna Template)
- **Lokasi views**: `resources/views/frontend/`
- **Layout master**: `resources/views/layouts/frontend.blade.php`
- **Assets**: `public/frontend/` (CSS, JS, images dari Eterna)
- **Navigasi**: BERANDA | PROFIL ▾ | PROGRAM STUDI ▾ | KEMAHASISWAAN ▾ | TRIDHARMA ▾ | BERITA | HUBUNGI KAMI
- **Komponen wajib**: Topbar info, Navbar, Breadcrumb, Sidebar Artikel Terkini, Footer 4-kolom

### 2. Admin Panel (CoreUI Template)
- **Lokasi views**: `resources/views/admin/`
- **Layout master**: `resources/views/layouts/admin.blade.php`
- **Assets**: `public/admin/` (CSS, JS dari CoreUI Free)
- **Akses**: Protected via `auth` middleware
- **Komponen wajib**: Sidebar menu, Header with search/notifications, DataTables, SweetAlert2

## Struktur Folder Proyek:

```
website-jurusan/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Frontend/       ← Controller halaman publik
│   │   │   └── Admin/          ← Controller CRUD admin
│   │   ├── Requests/           ← Form Request validasi
│   │   └── Middleware/
│   ├── Models/                 ← Eloquent models
│   ├── Repositories/           ← Repository pattern
│   └── Providers/
├── resources/
│   └── views/
│       ├── layouts/            ← Master layouts
│       │   ├── frontend.blade.php
│       │   ├── admin.blade.php
│       │   └── partials/
│       ├── frontend/           ← Views publik
│       ├── admin/              ← Views admin CRUD
│       └── auth/               ← Login/Register
├── public/
│   ├── frontend/               ← Asset Eterna (Bootstrap 5)
│   └── admin/                  ← Asset CoreUI
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
└── .agents/                    ← Rules & Workflows
```

## Referensi:
- Proyek lama: `C:\Users\riki\Documents\PBL_Jurusan_R&K\jurusanpolitani-main\`
- Template Eterna: `C:\Users\riki\Documents\PBL_Jurusan_R&K\Eterna\`
- Template CoreUI: `C:\Users\riki\Documents\PBL_Jurusan_R&K\coreui_admin\`
- Data Jurusan: `C:\Users\riki\Documents\PBL_Jurusan_R&K\Data Jurusan R&K\`
- Screenshot lama: `C:\Users\riki\Documents\PBL_Jurusan_R&K\Eterna\ss pbl lama\`
