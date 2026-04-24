# Workflow: Dev Server

## Cara Menjalankan Server Development

### 1. Pastikan Berada di Direktori Proyek
```bash
cd C:\Users\riki\Documents\PBL_Jurusan_R&K\website-jurusan
```

### 2. Install Dependencies (Pertama Kali Saja)
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Pastikan file `.env` sudah terkonfigurasi:
```env
APP_NAME="Website Jurusan R&K"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=website_jurusan
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database (Pertama Kali)
```bash
# Buat database MySQL
mysql -u root -e "CREATE DATABASE IF NOT EXISTS website_jurusan;"

# Jalankan migrasi + seeder
php artisan migrate:fresh --seed

# Buat symlink storage
php artisan storage:link
```

### 5. Jalankan Server
```bash
# Opsi 1: Composer dev (semua sekaligus)
composer dev

# Opsi 2: Manual (jika composer dev tidak tersedia)
# Terminal 1:
php artisan serve
# Terminal 2:
npm run dev
```

### 6. Akses
- **Frontend**: http://localhost:8000
- **Admin Login**: http://localhost:8000/login
- **Credential**: Lihat file `.agents/rules/akun-test.md`

### 7. Akses dari Device Lain (Mobile Testing)
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
Kemudian akses via `http://{IP_KOMPUTER}:8000` dari device lain.
