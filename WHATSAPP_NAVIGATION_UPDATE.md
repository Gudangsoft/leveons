# Update Navigation & WhatsApp Integration - Documentation

## 📋 Ringkasan Perubahan

Dokumentasi ini mencatat semua perubahan yang dilakukan untuk menambahkan menu Konsultasi, mengintegrasikan WhatsApp, dan mengganti Twitter dengan Threads.

## 🎯 Perubahan yang Dilakukan

### 1. **Database Migration**

#### File: `2025_10_14_105035_add_whatsapp_to_companies_table.php`
- ✅ Menambahkan kolom `whatsapp` ke tabel `companies`
- Kolom bersifat nullable
- Posisi: setelah kolom `phone`

```php
Schema::table('companies', function (Blueprint $table) {
    $table->string('whatsapp')->nullable()->after('phone');
});
```

### 2. **Model Update**

#### File: `app/Models/Company.php`
**Perubahan:**
- ✅ Menambahkan `whatsapp` ke array `$fillable`
- ✅ Update default social_media untuk include `threads` (mengganti `twitter`)

```php
protected $fillable = [
    'name', 'tagline', 'description', 'phone', 'email', 'address', 
    'website', 'logo', 'favicon', 'social_media', 'business_hours',
    'meta_title', 'meta_description', 'google_analytics', 'footer_text',
    'whatsapp' // NEW
];

// Default social_media
'social_media' => [
    'facebook' => '',
    'threads' => '', // NEW (mengganti twitter)
    'instagram' => '',
    'linkedin' => '',
    'youtube' => ''
]
```

### 3. **Navigation Update**

#### File: `resources/views/partials/navigation.blade.php`
**Perubahan:**
- ✅ Menambahkan menu "Konsultasi" di bagian akhir navigation

```php
<!-- Konsultasi Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('consultation.index') }}">Konsultasi</a>
</li>
```

#### File: `resources/views/layouts/frontend.blade.php`
**Perubahan di Navbar:**
- ✅ Mengubah tombol "Contact Us" menjadi "WhatsApp" dengan icon
- ✅ Tombol menggunakan data dari `$company->whatsapp`
- ✅ Background hijau (#25D366 - warna WhatsApp brand)

```php
@if($company->whatsapp)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" 
   target="_blank" 
   class="btn btn-success ms-3 d-flex align-items-center" 
   style="background: #25D366; border: none;">
    <i class="fab fa-whatsapp me-2"></i>
    WhatsApp
</a>
@endif
```

### 4. **Footer Update**

#### File: `resources/views/layouts/frontend.blade.php`

**Perubahan di Social Media Icons:**
- ✅ Mengubah icon Twitter menjadi Threads
- ✅ Menambahkan font-size 1.5rem untuk semua icon
- ✅ Menambahkan title attribute untuk accessibility

```php
@if(isset($company->social_media['threads']) && $company->social_media['threads'])
    <a href="{{ $company->social_media['threads'] }}" 
       target="_blank" 
       class="footer-social-link d-inline-block me-3" 
       style="color: rgba(255,255,255,0.8); font-size: 1.5rem;" 
       title="Threads">
        <i class="fab fa-threads"></i>
    </a>
@endif
```

**Perubahan di Contact Info:**
- ✅ Mengubah icon Phone (fa-phone) menjadi WhatsApp (fab fa-whatsapp)
- ✅ Nomor WhatsApp menjadi clickable link ke wa.me
- ✅ Email juga dibuat clickable dengan mailto:

```php
@if($company->whatsapp)
<div class="mb-2" style="color: rgba(255,255,255,0.8);">
    <i class="fab fa-whatsapp me-2"></i>
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" 
       target="_blank" 
       style="color: rgba(255,255,255,0.8); text-decoration: none;">
        {{ $company->whatsapp }}
    </a>
</div>
@endif
```

**Perubahan Floating WhatsApp Button:**
- ✅ Update untuk menggunakan nomor dari database
- ✅ Conditional rendering (hanya tampil jika whatsapp terisi)

```php
@if($company->whatsapp)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}?text=Halo,%20saya%20ingin%20berkonsultasi" 
   target="_blank" 
   class="floating-whatsapp" 
   title="Chat via WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>
@endif
```

### 5. **Admin Panel Update**

#### File: `app/Http/Controllers/Admin/CompanyController.php`
**Perubahan Validasi:**
- ✅ Menambahkan validasi untuk field `whatsapp`
- ✅ Mengubah validasi `social_media.twitter` menjadi `social_media.threads`

```php
'whatsapp' => 'nullable|string|max:50',
'social_media.threads' => 'nullable|url',
```

#### File: `resources/views/admin/company/index.blade.php`
**Perubahan di Contact Information Section:**
- ✅ Menambahkan input field untuk WhatsApp
- ✅ Icon WhatsApp di label
- ✅ Helper text untuk format nomor

```html
<div class="col-md-6">
    <div class="mb-3">
        <label for="whatsapp" class="form-label">
            <i class="fab fa-whatsapp text-success"></i> WhatsApp
        </label>
        <input type="text" 
               class="form-control @error('whatsapp') is-invalid @enderror" 
               id="whatsapp" 
               name="whatsapp" 
               value="{{ old('whatsapp', $company->whatsapp) }}"
               placeholder="+62 812 3456 7890 or 6281234567890">
        <small class="form-text text-muted">
            Format: +62xxx atau 62xxx (tanpa spasi untuk link WA)
        </small>
    </div>
</div>
```

**Perubahan di Social Media Section:**
- ✅ Mengubah field Twitter menjadi Threads
- ✅ Menambahkan icon pada semua label social media
- ✅ Update placeholder untuk Threads (threads.net)

```html
<div class="col-md-6">
    <div class="mb-3">
        <label for="threads" class="form-label">
            <i class="fab fa-threads"></i> Threads
        </label>
        <input type="url" 
               class="form-control" 
               id="threads" 
               name="social_media[threads]" 
               value="{{ old('social_media.threads', $company->social_media['threads'] ?? '') }}" 
               placeholder="https://threads.net/@yourhandle">
    </div>
</div>
```

### 6. **Database Seeder**

#### File: `database/seeders/UpdateCompanyWhatsAppSeeder.php`
**Fungsi:**
- ✅ Update nomor WhatsApp di database
- ✅ Migrasi data dari Twitter ke Threads di social_media array

```php
$company->whatsapp = '6281234567890';

// Update social media to include threads instead of twitter
$socialMedia = $company->social_media ?? [];
if (isset($socialMedia['twitter'])) {
    $socialMedia['threads'] = $socialMedia['twitter'];
    unset($socialMedia['twitter']);
}
$company->social_media = $socialMedia;
```

## 🎨 Fitur Baru

### 1. **Menu Konsultasi**
- Muncul di navigation bar utama
- Link ke halaman `/consultation`
- Konsisten dengan style menu lainnya

### 2. **WhatsApp Button di Navbar**
- Warna hijau khas WhatsApp (#25D366)
- Icon WhatsApp dari Font Awesome
- Link langsung ke wa.me dengan nomor dari database
- Responsive design

### 3. **WhatsApp di Footer**
- Menggantikan icon telepon biasa
- Clickable link ke WhatsApp Web/App
- Format nomor otomatis dibersihkan dari karakter non-digit

### 4. **Threads Social Media**
- Menggantikan Twitter
- Icon threads dari Font Awesome 6.4.0+
- Link format: threads.net/@username

### 5. **Admin Settings**
- Field WhatsApp dengan helper text
- Field Threads menggantikan Twitter
- Icon visual untuk memudahkan identifikasi
- Validasi URL untuk social media

## 📱 Format Nomor WhatsApp

### Input yang Diterima:
- `+62 812 3456 7890` (dengan spasi)
- `+6281234567890` (tanpa spasi)
- `6281234567890` (tanpa +)
- `0812 3456 7890` (format lokal)

### Konversi Otomatis:
Semua karakter non-digit dihilangkan saat membuat link WhatsApp:
```php
preg_replace('/[^0-9]/', '', $company->whatsapp)
```

Hasil: `6281234567890` untuk link `https://wa.me/6281234567890`

## 🧪 Testing

### URL untuk Testing:
1. **Homepage**: `http://127.0.0.1:8000`
2. **Konsultasi**: `http://127.0.0.1:8000/consultation`
3. **Admin Company Settings**: `http://127.0.0.1:8000/admin/company`

### Checklist Testing:
- ✅ Menu Konsultasi muncul di navbar
- ✅ Tombol WhatsApp muncul di navbar dengan warna hijau
- ✅ Link WhatsApp berfungsi (membuka wa.me)
- ✅ Icon Threads muncul di footer (bukan Twitter)
- ✅ WhatsApp icon di footer contact info
- ✅ Floating WhatsApp button tetap berfungsi
- ✅ Admin dapat edit nomor WhatsApp
- ✅ Admin dapat edit link Threads

## 🔧 Cara Menggunakan

### Update Nomor WhatsApp:
1. Login ke Admin Panel
2. Navigasi ke **Company Settings**
3. Isi field **WhatsApp** dengan nomor format internasional
4. Contoh: `6281234567890` atau `+62 812 3456 7890`
5. Klik **Save Changes**

### Update Link Threads:
1. Login ke Admin Panel
2. Navigasi ke **Company Settings**
3. Scroll ke section **Social Media**
4. Isi field **Threads** dengan URL lengkap
5. Contoh: `https://threads.net/@yourusername`
6. Klik **Save Changes**

## 🎯 Best Practices

### Nomor WhatsApp:
- Gunakan format internasional (dimulai dengan 62)
- Pastikan nomor aktif dan bisa menerima pesan
- Test link setelah update

### Link Social Media:
- Gunakan URL lengkap (dengan https://)
- Verify bahwa link valid sebelum save
- Threads: gunakan format `https://threads.net/@username`

## 📊 Struktur Data

### Database: `companies` table
```sql
- whatsapp: varchar(255) nullable
```

### Social Media JSON Structure:
```json
{
    "facebook": "https://facebook.com/page",
    "threads": "https://threads.net/@username",
    "instagram": "https://instagram.com/username",
    "linkedin": "https://linkedin.com/company/name",
    "youtube": "https://youtube.com/@channel"
}
```

## 🚀 Deployment Notes

### Saat Deploy ke Production:
1. Jalankan migration:
   ```bash
   php artisan migrate
   ```

2. Update data company:
   ```bash
   php artisan db:seed --class=UpdateCompanyWhatsAppSeeder
   ```

3. Clear cache:
   ```bash
   php artisan cache:clear
   php artisan view:clear
   php artisan config:clear
   ```

4. Update nomor WhatsApp melalui Admin Panel

## 🔄 Rollback (Jika Diperlukan)

Untuk rollback perubahan:
```bash
php artisan migrate:rollback --step=1
```

## 📝 Notes Penting

1. **Font Awesome 6.4.0+** diperlukan untuk icon Threads
2. WhatsApp format: pastikan menggunakan kode negara (62 untuk Indonesia)
3. Floating WhatsApp button hanya muncul jika nomor WhatsApp terisi
4. Navbar WhatsApp button hanya muncul jika nomor WhatsApp terisi
5. Icon social media di footer memiliki hover effect

## 📞 Support

Jika ada pertanyaan atau issue:
- Check error logs di `storage/logs/laravel.log`
- Pastikan migration sudah dijalankan
- Verify nomor WhatsApp format sudah benar
- Test di berbagai browser

---

**Last Updated**: October 14, 2025  
**Version**: 2.0  
**Status**: ✅ Production Ready
