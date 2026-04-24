# Skill: Debugging Sistematis (4 Fase)

## Prinsip
Jangan langsung menebak penyebab error. Ikuti 4 fase ini secara berurutan.

---

## Fase 1: REPRODUCE (Reproduksi)
1. Konfirmasi langkah-langkah untuk memicu error
2. Catat **error message** yang tepat (copy paste, bukan parafrase)
3. Identifikasi: kapan error terjadi? (saat create? update? view?)
4. Cek log: `storage/logs/laravel.log`

## Fase 2: ISOLATE (Isolasi)
1. **File mana** yang menyebabkan error? (Model? Controller? View? Route?)
2. **Line berapa** error terjadi?
3. Apakah error di backend (PHP) atau frontend (JS/Blade)?
4. Cek apakah error hanya di environment tertentu (dev vs production)

## Fase 3: FIX (Perbaiki)
1. Buat **hipotesis** penyebab error
2. Terapkan fix yang **minimal** — jangan ubah lebih dari yang diperlukan
3. Jika tidak yakin, coba di branch terpisah

## Fase 4: VERIFY (Verifikasi)
1. Jalankan kembali langkah reproduksi — error harus hilang
2. Jalankan `php artisan test` — tidak ada test yang rusak
3. Jalankan `./vendor/bin/pint --test` — kode tetap rapi
4. Cek apakah fix tidak merusak fitur lain (regression test)

---

## Tools Debugging Laravel

```bash
# Cek log terbaru
tail -f storage/logs/laravel.log

# Cek routes
php artisan route:list --compact

# Cek database
php artisan tinker
>>> Blog::count()
>>> User::first()

# Cek migration status
php artisan migrate:status

# Clear semua cache
php artisan optimize:clear
```

## Aturan
- ❌ JANGAN langsung hapus kode tanpa memahami penyebab error
- ❌ JANGAN skip Fase 4 (Verifikasi)
- ✅ SELALU cek log Laravel terlebih dahulu
- ✅ SELALU reproduksi error sebelum memperbaiki
