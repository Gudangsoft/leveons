# Fix Production Error - WhatsApp Column

## 🔴 Error Description

**Error**: `Column not found: 1054 Unknown column 'whatsapp' in 'field list'`

**Cause**: Migration untuk menambahkan kolom `whatsapp` belum dijalankan di production server.

## 🔧 Solution Options

### Option 1: Run Migration (Recommended)

Jalankan migration di server production:

```bash
# SSH ke server production
ssh user@your-server.com

# Navigate ke project directory
cd /path/to/leveons2

# Run migration
php artisan migrate

# Optional: Run seeder untuk update data
php artisan db:seed --class=UpdateCompanyWhatsAppSeeder
```

### Option 2: Manual SQL (Quick Fix)

Jika tidak bisa SSH atau run migration, execute SQL ini di database production:

```sql
-- Add whatsapp column to companies table
ALTER TABLE `companies` 
ADD COLUMN `whatsapp` VARCHAR(255) NULL 
AFTER `phone`;

-- Update existing data (optional)
UPDATE `companies` 
SET `whatsapp` = '6281234567890' 
WHERE `id` = 1;
```

### Option 3: Already Fixed in Code (Current)

Code sudah di-update untuk handle jika kolom belum ada:

#### Updated Files:

1. **app/Http/Controllers/Admin/CompanyController.php**
   ```php
   // Check if whatsapp column exists before trying to save
   if (\Schema::hasColumn('companies', 'whatsapp')) {
       $company->fill($fillData);
   } else {
       // If whatsapp column doesn't exist, exclude it
       $company->fill(collect($fillData)->except('whatsapp')->toArray());
   }
   ```

2. **app/Models/Company.php**
   ```php
   public function getWhatsappAttribute($value)
   {
       if (!\Schema::hasColumn('companies', 'whatsapp')) {
           return null;
       }
       return $value;
   }
   ```

3. **resources/views/layouts/frontend.blade.php**
   - Semua penggunaan `$company->whatsapp` sudah wrapped dengan `@if($company->whatsapp)`
   - Tombol WhatsApp hanya muncul jika ada nomor
   - Floating button juga conditional

## ✅ Verification Steps

### After Fix:

1. **Test Admin Panel**
   ```
   https://leveons.id/admin/company
   ```
   - Should load without error
   - Can update company settings
   - WhatsApp field appears (if column exists) or hidden (if not)

2. **Test Frontend**
   ```
   https://leveons.id
   ```
   - Homepage loads without error
   - WhatsApp button appears if number is set
   - Footer displays correctly

3. **Check Database**
   ```sql
   -- Check if column exists
   SHOW COLUMNS FROM companies LIKE 'whatsapp';
   
   -- Check current value
   SELECT id, name, phone, whatsapp FROM companies;
   ```

## 🚀 Deployment Steps

### For Future Deployments:

1. **Pull latest code**
   ```bash
   git pull origin main
   ```

2. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

3. **Clear cache**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

4. **Update composer** (if needed)
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

5. **Set permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

## 📋 Migration Files

### Required Migrations (in order):

1. `2025_09_25_095555_create_companies_table.php` ✅ (Already exists)
2. `2025_10_14_105035_add_whatsapp_to_companies_table.php` ⚠️ (Needs to run)

### Check Migration Status:

```bash
# See which migrations have run
php artisan migrate:status

# If migration is pending
php artisan migrate
```

## 🔍 Troubleshooting

### Error persists after migration?

1. **Clear application cache**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

2. **Check database connection**
   ```bash
   php artisan tinker
   >>> \DB::connection()->getPdo();
   ```

3. **Verify column exists**
   ```bash
   php artisan tinker
   >>> \Schema::hasColumn('companies', 'whatsapp');
   ```

### Migration fails?

1. **Check database user permissions**
   ```sql
   SHOW GRANTS FOR 'your_db_user'@'localhost';
   ```

2. **Manual column addition**
   - Use Option 2 SQL above
   - Verify with `SHOW COLUMNS FROM companies;`

3. **Check for locked tables**
   ```sql
   SHOW PROCESSLIST;
   SHOW OPEN TABLES WHERE In_use > 0;
   ```

## 📊 Database Schema

### Before Fix:
```
companies
├── id
├── name
├── tagline
├── description
├── phone          ← Last field
├── email
├── address
├── website
├── logo
├── favicon
├── social_media (JSON)
├── business_hours (JSON)
├── meta_title
├── meta_description
├── google_analytics
├── footer_text
├── created_at
└── updated_at
```

### After Fix:
```
companies
├── id
├── name
├── tagline
├── description
├── phone
├── whatsapp       ← NEW FIELD
├── email
├── address
├── website
├── logo
├── favicon
├── social_media (JSON)
├── business_hours (JSON)
├── meta_title
├── meta_description
├── google_analytics
├── footer_text
├── created_at
└── updated_at
```

## 🎯 Current Status

- ✅ Code updated to handle missing column
- ✅ Views updated with conditional rendering
- ✅ Controller updated with column check
- ✅ Model updated with accessor
- ⚠️ Migration needs to run on production
- ⚠️ Database schema needs update

## 💡 Prevention for Future

1. **Always run migrations on production** after deployment
2. **Test on staging** environment first
3. **Backup database** before migrations
4. **Use migration rollback** if issues occur
5. **Monitor error logs** after deployment

## 📞 Quick Contact

If issues persist:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs: `/var/log/apache2/error.log` or nginx equivalent
3. Enable debug mode temporarily: `APP_DEBUG=true` in `.env`
4. Check database connectivity and permissions

## 🔐 Security Note

Remember to disable debug mode after fixing:
```bash
# In .env file
APP_DEBUG=false
APP_ENV=production
```

---

**Last Updated**: October 14, 2025  
**Status**: 🟡 Waiting for migration run  
**Priority**: High  
**Estimated Fix Time**: 5 minutes  
**Risk Level**: Low (backward compatible)
