# Workflow: Build Check

## Langkah-langkah Pengecekan

### 1. Linter (PHP Code Style)
```bash
./vendor/bin/pint --test
```
Jika ada error: jalankan `./vendor/bin/pint` untuk auto-fix.

### 2. Tests
```bash
php artisan test
```
Semua test harus pass. Jika ada yang gagal, perbaiki sebelum lanjut.

### 3. Route Check
```bash
php artisan route:list
```
Pastikan:
- Tidak ada route duplikat
- Semua route menunjuk ke controller yang ada
- Admin routes dilindungi middleware `auth`

### 4. Migration Check (Development Only!)
```bash
php artisan migrate:fresh --seed
```
⚠️ **HANYA di development!** Ini akan menghapus semua data.

### 5. Cache Clear
```bash
php artisan optimize:clear
```

### 6. Asset Build
```bash
npm run build
```
Pastikan tidak ada error saat compile.

---

## Kapan Jalankan Build Check?
- ✅ Setelah menyelesaikan fitur baru
- ✅ Sebelum push ke Git
- ✅ Setelah merge branch
- ✅ Saat ada error yang tidak jelas penyebabnya
