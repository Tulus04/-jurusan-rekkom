# Deployment: Website Jurusan R&K

## Prinsip
Production HARUS stabil, cepat, dan aman. JANGAN deploy code yang belum tested.

---

## 1. Environment Setup Production

### `.env.production`
```env
APP_NAME="Jurusan R&K Politani"
APP_ENV=production
APP_DEBUG=false                  ← WAJIB false
APP_URL=https://rekkom.politani.ac.id

LOG_CHANNEL=daily
LOG_LEVEL=error                  ← Jangan debug di prod

DB_CONNECTION=mysql
DB_HOST=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...                  ← Strong password!

MAIL_MAILER=smtp
MAIL_HOST=...                    ← Email transactional

CACHE_STORE=redis                ← Pakai Redis di prod (kalau ada)
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Larangan Production .env
- ❌ `APP_DEBUG=true` — leak detail error
- ❌ `APP_KEY=` kosong — generate via `php artisan key:generate`
- ❌ DB_PASSWORD lemah atau default
- ❌ Email/notification credential dummy

---

## 2. Pre-Deploy Checklist

### Code Quality
- [ ] `php vendor/laravel/pint/builds/pint --test` PASS
- [ ] `php artisan test` PASS
- [ ] No `dd()`, `dump()`, `var_dump()` tersisa
- [ ] No `console.log()` di production JS

### Security
- [ ] `.env.production` ada (jangan commit ke Git)
- [ ] `APP_KEY` di-generate
- [ ] HTTPS aktif (Let's Encrypt atau cert)
- [ ] CSRF & XSS protection aktif (default Laravel)
- [ ] File upload validation ketat
- [ ] Rate limiting di route sensitif

### Database
- [ ] Backup DB sebelum migrate
- [ ] `php artisan migrate --force` (production)
- [ ] Seeder hanya untuk data master (jangan seed dummy)

### Asset
- [ ] `npm run build` (BUKAN `npm run dev`)
- [ ] `php artisan storage:link`
- [ ] Image sudah di-optimize

---

## 3. Deployment Commands

### First Deploy
```bash
# Clone repo
git clone {repo} /var/www/rekkom

# Install dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Setup
cp .env.example .env
# Edit .env
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder --force

# Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Permission (Linux)
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Re-deploy (Update)
```bash
cd /var/www/rekkom

# Maintenance mode
php artisan down --message="Maintenance, kembali dalam 5 menit"

# Pull & install
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Migrate
php artisan migrate --force

# Re-cache
php artisan optimize:clear
php artisan optimize

# Resume
php artisan up
```

---

## 4. Web Server Config

### Nginx (Recommended)
```nginx
server {
    listen 443 ssl http2;
    server_name rekkom.politani.ac.id;
    root /var/www/rekkom/public;
    
    ssl_certificate /etc/letsencrypt/live/rekkom.politani.ac.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/rekkom.politani.ac.id/privkey.pem;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name rekkom.politani.ac.id;
    return 301 https://$host$request_uri;
}
```

---

## 5. Backup Strategy

### Database
```bash
# Daily backup (cron)
mysqldump -u root -p website_jurusan > /backup/db-$(date +%F).sql

# Retention: 30 hari
find /backup -name "db-*.sql" -mtime +30 -delete
```

### File Upload
```bash
# Sync storage ke backup server
rsync -avz /var/www/rekkom/storage/app/public/ /backup/storage/
```

### Off-site Backup
- Cloud storage (Google Drive, Dropbox, S3)
- Minimal weekly full backup

---

## 6. Monitoring

### Tools Wajib
- **Laravel Telescope** (dev only, jangan production)
- **Laravel Pulse** untuk production monitoring
- **Sentry** atau **Bugsnag** untuk error tracking
- Server uptime monitor (UptimeRobot, Pingdom)

### Log Rotation
```php
// config/logging.php
'daily' => [
    'driver' => 'daily',
    'days'   => 14,        ← simpan 14 hari
],
```

---

## 7. Rollback Plan

Kalau deploy gagal:
```bash
# Rollback code
git reset --hard HEAD~1

# Rollback migration
php artisan migrate:rollback --step=1

# Restore DB dari backup
mysql -u root -p website_jurusan < /backup/db-2026-04-30.sql

# Re-cache
php artisan optimize:clear
php artisan optimize
```

---

## 8. Performance Production

```bash
# Cache config (15-30% faster)
php artisan config:cache

# Cache routes (10% faster di app dengan banyak route)
php artisan route:cache

# Cache views (kompilasi blade ke PHP murni)
php artisan view:cache

# Optimize composer autoload
composer dump-autoload --optimize

# Atau semua sekaligus
php artisan optimize
```

### Cache TIDAK boleh di-cache
- Saat development (akan stale)
- Setelah update route/config (clear dulu)

---

## 9. Security Hardening

```bash
# Permission rules
sudo chmod -R 755 /var/www/rekkom
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache

# Hide .env
chmod 600 .env

# Disable directory listing (Nginx default OFF)
# Disable PHP execution di /storage (via web server config)
```

---

## 10. Larangan Production

- ❌ JANGAN `php artisan tinker` di production untuk modify data
- ❌ JANGAN `php artisan migrate:fresh` di production (hapus semua data!)
- ❌ JANGAN deploy langsung ke main tanpa test di staging
- ❌ JANGAN expose `.env` via web (cek lewat `https://yourdomain.com/.env`)
- ❌ JANGAN biarkan `APP_DEBUG=true`
- ❌ JANGAN pakai password default user `password`
