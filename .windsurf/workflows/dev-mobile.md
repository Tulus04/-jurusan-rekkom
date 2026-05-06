---
description: Jalankan Laravel dev server agar bisa diakses dari HP / device di WiFi yang sama
---

Gunakan workflow ini ketika ingin mengetes tampilan web di HP (mobile).
Prasyarat: HP dan laptop terhubung ke WiFi yang SAMA.

## Langkah 1: Deteksi IP LAN laptop

Cari baris `IPv4` yang formatnya `192.168.x.x` atau `10.x.x.x` (bukan `192.168.56.x`
yang biasanya virtual adapter VirtualBox).

// turbo
```powershell
ipconfig | findstr /i "IPv4"
```

## Langkah 2: (Sekali saja) Buka firewall port 8000

Lewati kalau HP sudah bisa akses. Kalau HP "tidak bisa menjangkau situs", jalankan ini
**sebagai Administrator**:

```powershell
New-NetFirewallRule -DisplayName "Laravel Dev 8000" -Direction Inbound -Protocol TCP -LocalPort 8000 -Action Allow
```

## Langkah 3: Clear cache (optional tapi aman)

// turbo
```powershell
php artisan view:clear
php artisan config:clear
```

## Langkah 4: Jalankan server — bind ke semua interface

```powershell
php artisan serve --host=0.0.0.0 --port=8000
```

Biarkan terminal ini jalan selama development.

## Langkah 5: Buka di device

- **Laptop**: `http://localhost:8000` atau `http://127.0.0.1:8000`
- **HP** (WiFi sama): `http://<IP_LAN_LAPTOP>:8000`
  - Contoh: kalau IP laptop `192.168.1.9` → HP buka `http://192.168.1.9:8000`

**Jangan pernah ketik `http://0.0.0.0:8000`** — itu bukan URL yang valid untuk browser
(browser tampilkan `ERR_ADDRESS_INVALID`).

## Troubleshooting

| Gejala | Penyebab & Solusi |
|---|---|
| HP: "Situs tidak dapat dijangkau" | Firewall Windows memblokir. Jalankan command di Langkah 2. |
| HP: halaman load tapi CSS/gambar broken | `APP_URL` di `.env` hardcode `localhost`. Ubah ke `http://<IP_LAN>:8000` lalu `php artisan config:clear`. |
| HP: login/redirect nyangkut | Session cookie domain beda. Cek `config/session.php` `domain` → biarkan `null`. |
| Laptop & HP pakai URL berbeda bikin session reset | Wajar karena cookie dibatasi per-host. Pakai satu URL konsisten (IP LAN) di kedua device kalau perlu session shared. |
