---
description: Setup & jalankan development server (DB, migrate, seed, serve)
---

# Workflow: Dev Server

## 1. Lokasi Proyek
```
C:\Users\riki\Documents\PBL_Jurusan_R&K\website-jurusan
```

## 2. Install Dependencies (Pertama Kali)
// turbo
```powershell
composer install
npm install
```

## 3. Konfigurasi Environment
Pastikan `.env` punya:
```env
APP_NAME="Website Jurusan R&K"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_DATABASE=website_jurusan
DB_USERNAME=root
DB_PASSWORD=
```

## 4. Setup Database (Pertama Kali)
```powershell
mysql -u root -e "CREATE DATABASE IF NOT EXISTS website_jurusan;"
php artisan migrate:fresh --seed
php artisan storage:link
```

## 5. Cek Server Status (sebelum start baru)
// turbo
```powershell
netstat -ano | findstr ":8000"
```

## 6. Jalankan Server
```powershell
# Opsi 1: All-in-one (server + queue + logs + vite)
composer dev

# Opsi 2: Manual — terminal terpisah
php artisan serve
npm run dev
```

## 7. Akses
- Frontend: http://localhost:8000
- Admin: http://localhost:8000/login
- Credential: lihat `.agents/rules/akun-test.md`

## 8. Mobile Testing
```powershell
php artisan serve --host=0.0.0.0 --port=8000
```
Akses dari device lain via `http://{IP_KOMPUTER}:8000`.
