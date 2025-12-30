# Panduan Upload ke Hosting (Production Deployment)

## 📋 Ringkasan Status Sistem

### ✅ Fitur yang Sudah Siap
1. **Sistem Konsultan** - CRUD lengkap, upload gambar, status publish
2. **Paket Konsultasi** - Database terpisah dengan CRUD admin
3. **Sistem Booking** - Kalender interaktif, form detail, invoice, konfirmasi
4. **Konfirmasi WhatsApp & Email** - Tombol otomatis dengan pesan
5. **Admin Management** - Kelola booking, filter, statistik
6. **Frontend** - Responsive design, kartu kuning, profil konsultan

### ✅ Keamanan & Validasi
- CSRF protection aktif
- SQL injection prevention (Eloquent ORM)
- File upload validation
- Form validation lengkap
- Session management aman

## 🚀 Langkah-Langkah Upload ke Hosting

### LANGKAH 1: Persiapan File
```bash
# Di komputer lokal, pastikan semua perubahan tersimpan
git add .
git commit -m "Ready for production deployment"

# Atau compress folder project (exclude vendor, node_modules)
# Jangan upload: vendor/, node_modules/, storage/logs/, .env
```

### LANGKAH 2: Upload ke Server

**Opsi A: Via cPanel File Manager**
1. Login ke cPanel hosting
2. Buka File Manager
3. Upload file ZIP ke folder `public_html` atau folder domain
4. Extract file ZIP
5. Pindahkan isi folder Laravel ke root (jika perlu)

**Opsi B: Via FTP (FileZilla)**
1. Connect ke server FTP
2. Upload semua file KECUALI:
   - `/vendor` (akan di-install via Composer)
   - `/node_modules` (akan di-install via npm)
   - `/.env` (akan dibuat manual)
   - `/storage/logs/*`

**Opsi C: Via Git (Recommended)**
```bash
# Di server (SSH)
cd public_html
git clone https://github.com/username/leveons.git .
```

### LANGKAH 3: Install Dependencies

**Via SSH (Terminal Server):**
```bash
# Masuk ke folder project
cd /home/username/public_html

# Install Composer dependencies
composer install --optimize-autoloader --no-dev

# Install NPM dependencies dan build assets
npm install
npm run build

# Atau jika tidak ada Node.js di server, build di lokal lalu upload folder public/build
```

**Via cPanel (jika tidak ada SSH):**
- Hubungi hosting support untuk install Composer dependencies
- Atau upload folder `vendor` dari lokal (sudah jalan `composer install`)

### LANGKAH 4: Konfigurasi Environment (.env)

1. **Copy file .env.production.example ke .env**
```bash
cp .env.production.example .env
```

2. **Edit .env dengan setting production:**
```properties
APP_NAME="Leveons"
APP_ENV=production
APP_KEY=  # Akan di-generate
APP_DEBUG=false
APP_URL=https://leveons.id  # Ganti dengan domain Anda

DB_CONNECTION=mysql
DB_HOST=localhost  # Atau IP database server
DB_PORT=3306
DB_DATABASE=nama_database_production
DB_USERNAME=user_database
DB_PASSWORD=password_database

# Email Settings (Gmail/SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@leveons.id
MAIL_PASSWORD=your_app_password  # Gunakan App Password untuk Gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@leveons.id
MAIL_FROM_NAME="Leveons"
```

3. **Generate Application Key:**
```bash
php artisan key:generate
```

### LANGKAH 5: Setup Database

```bash
# Jalankan migrasi database
php artisan migrate --force

# Jika ada error permission, set ownership:
chown -R username:username storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

**Via cPanel phpMyAdmin (alternatif):**
1. Buat database baru di MySQL Databases
2. Import file SQL (jika ada) atau jalankan migrate via Artisan

### LANGKAH 6: Setup Storage & Permissions

```bash
# Create storage symlink
php artisan storage:link

# Set permissions (via SSH)
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership (ganti 'username' dengan user hosting)
chown -R username:username storage
chown -R username:username bootstrap/cache
```

**Via cPanel:**
- Set folder permissions:
  - `storage/` → 775
  - `bootstrap/cache/` → 775
  - Semua subfolder di `storage/` → 775

### LANGKAH 7: Optimize untuk Production

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Build cache untuk production (WAJIB)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize Composer autoloader
composer dump-autoload --optimize
```

### LANGKAH 8: Setup Web Server

**A. Jika menggunakan Apache (.htaccess):**

File `.htaccess` di folder `public/` sudah ada dari Laravel. Pastikan:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
</IfModule>
```

**B. Arahkan Domain ke folder /public:**

**Opsi 1: Via cPanel (Recommended)**
1. Buka cPanel → Domains atau Addon Domains
2. Set Document Root ke: `/public_html/public`

**Opsi 2: Symlink (jika root tidak bisa diubah)**
```bash
# Backup index.php asli
mv /home/username/public_html/index.php /home/username/public_html/index.php.bak

# Pindahkan Laravel ke subfolder
mv /home/username/public_html/* /home/username/public_html/leveons/

# Pindahkan isi folder public ke root
mv /home/username/public_html/leveons/public/* /home/username/public_html/
mv /home/username/public_html/leveons/public/.htaccess /home/username/public_html/

# Edit index.php di root, ubah path autoload dan bootstrap
```

Edit `/public_html/index.php`:
```php
require __DIR__.'/leveons/vendor/autoload.php';
$app = require_once __DIR__.'/leveons/bootstrap/app.php';
```

### LANGKAH 9: Testing Setelah Upload

**Checklist Testing:**
- [ ] Buka homepage → https://leveons.id ✅
- [ ] Akses admin → https://leveons.id/admin ✅
- [ ] Login admin berhasil ✅
- [ ] Lihat daftar konsultan → Admin & Frontend ✅
- [ ] Buat konsultan baru + upload gambar ✅
- [ ] Buat paket konsultasi ✅
- [ ] Test booking flow:
  - [ ] Pilih konsultan → Lihat Profil ✅
  - [ ] Klik Book Now → Kalender muncul ✅
  - [ ] Pilih tanggal & waktu ✅
  - [ ] Isi form details ✅
  - [ ] Review invoice ✅
  - [ ] Konfirmasi booking ✅
  - [ ] Klik tombol WhatsApp → Terbuka dengan pesan ✅
  - [ ] Klik tombol Email → Email client terbuka ✅
- [ ] Admin lihat booking baru ✅
- [ ] Update status booking ✅
- [ ] Test responsive di mobile ✅

### LANGKAH 10: Monitoring & Maintenance

```bash
# Cek error log
tail -f storage/logs/laravel.log

# Atau via cPanel → Error Log

# Setup cron job untuk scheduled tasks (jika diperlukan)
# cPanel → Cron Jobs
# */5 * * * * cd /home/username/public_html && php artisan schedule:run >> /dev/null 2>&1
```

## 🔧 Troubleshooting

### Error: "500 Internal Server Error"
```bash
# Check logs
cat storage/logs/laravel.log

# Pastikan permissions benar
chmod -R 775 storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Error: "Storage not found" saat upload gambar
```bash
# Recreate symlink
php artisan storage:link

# Atau buat manual (via cPanel File Manager)
# Symlink: public/storage → ../storage/app/public
```

### Error: "Base table or view not found"
```bash
# Jalankan migrasi
php artisan migrate --force

# Cek koneksi database di .env
```

### Error: "CSRF token mismatch"
```bash
# Pastikan APP_URL benar di .env
# Pastikan session driver berfungsi
# Clear config cache
php artisan config:cache
```

### Error: Gambar tidak muncul
```bash
# Pastikan symlink storage sudah dibuat
php artisan storage:link

# Atau cek path di Consultant model dan form upload
```

### WhatsApp/Email button tidak berfungsi
- Cek template confirmation.blade.php
- Pastikan $booking->consultant->name ada
- Test format nomor WhatsApp (62xxx)

## 📧 Konfigurasi Email (Gmail)

1. **Enable 2-Factor Authentication** di Google Account
2. **Generate App Password:**
   - Google Account → Security → App Passwords
   - Pilih "Mail" dan "Other device"
   - Copy password yang di-generate

3. **Update .env:**
```properties
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@leveons.id
MAIL_PASSWORD=generated_app_password  # 16 karakter dari Google
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@leveons.id
MAIL_FROM_NAME="Leveons"
```

4. **Test Email:**
```bash
php artisan tinker
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

## 🎯 Fitur Tambahan (Opsional)

### 1. Email Notification Otomatis untuk Admin
Buat Notification class untuk kirim email saat ada booking baru.

### 2. Backup Database Otomatis
Setup cron job untuk backup database setiap hari:
```bash
0 2 * * * mysqldump -u user -ppassword database > /backup/db_$(date +\%Y\%m\%d).sql
```

### 3. Google Analytics
Tambahkan tracking code di layout frontend.

### 4. SSL Certificate (HTTPS)
- Via cPanel → SSL/TLS → Install Let's Encrypt (gratis)
- Atau hubungi hosting support

## ✅ Kesimpulan

**Sistem SUDAH SIAP untuk production** dengan catatan:

✅ **Yang Sudah Berfungsi:**
- Semua fitur konsultan dan booking
- Admin management lengkap
- Database structure solid
- Security dasar terpasang
- Frontend responsive

⚠️ **Yang Perlu Dikonfigurasi di Server:**
- .env production settings
- Database credentials
- Email SMTP settings
- Storage permissions
- Web server configuration

📝 **Recommended (tapi tidak wajib):**
- Email notification otomatis
- Database backup otomatis
- Payment gateway integration

---

**Waktu estimasi deployment:** 30-60 menit
**Difficulty level:** Medium (perlu akses SSH atau cPanel)

Jika ada error saat deployment, cek file `storage/logs/laravel.log` untuk detail error.

**Support:** info@leveons.id
