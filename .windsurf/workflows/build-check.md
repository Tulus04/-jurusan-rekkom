---
description: Build check sebelum commit/push (Pint, Test, Route, Cache, Asset)
---

# Workflow: Build Check

Jalankan sebelum commit/push, setelah merge branch, atau saat error tidak jelas.

## 1. Linter PHP (Pint)
// turbo
```powershell
php vendor/laravel/pint/builds/pint --test
```
Jika ada issue: `php vendor/laravel/pint/builds/pint` untuk auto-fix.

## 2. PHPUnit Tests
// turbo
```powershell
php artisan test
```
Semua test HARUS pass. Jika gagal, perbaiki sebelum lanjut.

## 3. Route Check
// turbo
```powershell
php artisan route:list --compact
```
Pastikan:
- Tidak ada route duplikat
- Semua route menunjuk ke controller yang ada
- Admin routes dilindungi middleware `auth`

## 4. Migration Check (Development Only!)
⚠️ HANYA di development — akan menghapus semua data!
```powershell
php artisan migrate:fresh --seed
```

## 5. Cache Clear
// turbo
```powershell
php artisan optimize:clear
```

## 6. Asset Build
// turbo
```powershell
npm run build
```
Pastikan tidak ada error saat compile.

---

## Kapan Jalankan?
- Setelah menyelesaikan fitur baru
- Sebelum push ke Git
- Setelah merge branch
- Saat ada error yang tidak jelas penyebabnya
