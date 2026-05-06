---
description: Cara cari referensi dari proyek lama (jurusanpolitani-main) sebelum bangun fitur baru
---

# Workflow: Referensi Proyek Lama

## Tujuan
SELALU cek proyek lama sebelum bangun fitur baru — hemat waktu, jaga konsistensi.

## Lokasi Referensi

```
C:\Users\riki\Documents\PBL_Jurusan_R&K\
├── jurusanpolitani-main\               ← PROYEK LAMA (Laravel + Summernote)
│   ├── app\Models\                     → 21 model Eloquent
│   ├── resources\views\front\          → 31 Blade views frontend
│   ├── resources\views\back\           → 19 folder CRUD admin
│   └── routes\web.php                  → 227 baris routing
├── Eterna\
│   └── ss pbl lama\                   → 24 screenshot referensi visual
├── coreui_admin\                       → Template Admin
├── Data Jurusan R&K\                   → Konten (foto, dokumen)
└── website-jurusan\                    → PROYEK SAAT INI
```

## Cara Referensi

### Saat Membangun Fitur Baru:
1. Cek Model lama: `jurusanpolitani-main\app\Models\` → pelajari `$fillable`, relasi
2. Cek Routing lama: `jurusanpolitani-main\routes\web.php` → upgrade ke `Route::resource()`
3. Cek Views lama: `jurusanpolitani-main\resources\views\` → rebuild dengan Bootstrap 5
4. Cek Screenshot: `Eterna\ss pbl lama\` → referensi visual
5. Cek Data: `Data Jurusan R&K\` → seeder/konten awal

## Pola Upgrade (Lama → Baru)

| Lama | Baru |
|------|------|
| `$guarded = []` | `$fillable = [...]` |
| Validasi di Controller | Form Request terpisah |
| `Model::find($id)` | Route Model Binding |
| Delete via GET | DELETE method + SweetAlert2 |
| Summernote | **TinyMCE 7** (jQuery-free) |
| Select2 | **Tom Select** (jQuery-free) |
| native `confirm()` | SweetAlert2 |
| Route manual 7 baris/modul | `Route::resource()` 1 baris |
| Tanpa Activity Log | `spatie/laravel-activitylog` |

## Larangan
- ❌ JANGAN copy template Jobick admin (kating) — kita pakai CoreUI
- ❌ JANGAN copy Summernote — sudah diganti TinyMCE 7
- ❌ JANGAN pakai jQuery di frontend — admin only
