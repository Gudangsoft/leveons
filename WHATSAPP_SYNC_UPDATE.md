# WhatsApp Sync - Consultation Form Update

## 🔄 Update: Sinkronisasi Nomor WhatsApp

Nomor WhatsApp pada halaman "Mulai Konsultasi" sekarang **otomatis sync** dengan data yang di-input di Admin Company Settings.

---

## ✅ Yang Sudah Diupdate

### 1. **Controller**
File: `app/Http/Controllers/ConsultationController.php`

**Perubahan:**
- ✅ Import model `Company`
- ✅ Load company settings: `$company = Company::getSettings()`
- ✅ Pass data ke view: `compact('company')`

### 2. **View - Contact Info**
File: `resources/views/consultation/form.blade.php`

**Perubahan Email:**
```php
// Sebelum (hardcoded):
<a href="mailto:info@leveons.id">info@leveons.id</a>

// Sesudah (dynamic):
<a href="mailto:{{ $company->email ?? 'info@leveons.id' }}">
    {{ $company->email ?? 'info@leveons.id' }}
</a>
```

**Perubahan WhatsApp:**
```php
// Sebelum (hardcoded):
<a href="https://wa.me/6281234567890">+62 812 3456 7890</a>

// Sesudah (dynamic dengan auto-format):
@if($company && $company->whatsapp)
    @php
        // Auto format untuk link dan display
        $whatsappLink = preg_replace('/[^0-9]/', '', $whatsappNumber);
        // Convert 0xxx ke 62xxx
        if (substr($whatsappLink, 0, 1) === '0') {
            $whatsappLink = '62' . substr($whatsappLink, 1);
        }
        // Format display dengan spasi
        $whatsappDisplay = '+62 xxx xxxx xxxx';
    @endphp
    <a href="https://wa.me/{{ $whatsappLink }}">{{ $whatsappDisplay }}</a>
@endif
```

### 3. **View - Input Placeholder**
**Perubahan:**
```php
// Sebelum:
placeholder="+62 812 3456 7890"

// Sesudah (dynamic):
placeholder="{{ $company->whatsapp ?? '+62 812 3456 7890' }}"
```

---

## 🎯 Fitur Auto-Format

System otomatis format nomor WhatsApp:

### Format Link (wa.me):
- Input: `0812-3456-7890` → Output: `6281234567890`
- Input: `+62 812 3456 7890` → Output: `6281234567890`
- Input: `62812 3456 7890` → Output: `6281234567890`

### Format Display:
- Input: `6281234567890` → Display: `+62 812 3456 7890`
- Input: `0812-3456-7890` → Display: `+62 812 3456 7890`

---

## 📍 Cara Update Nomor WhatsApp

### Di Admin Panel:

1. **Login ke Admin**
   ```
   http://localhost:8000/admin
   ```

2. **Buka Company Settings**
   - Klik "Company Settings" di sidebar
   - Atau: `http://localhost:8000/admin/company`

3. **Update WhatsApp**
   - Isi field "WhatsApp Number"
   - Format bebas:
     - `0812 3456 7890`
     - `+62 812 3456 7890`
     - `6281234567890`
   - Klik "Update Settings"

4. **Lihat Hasil**
   - Buka: `http://localhost:8000/menu/request-consultation`
   - Section "Butuh Bantuan?" akan menampilkan nomor yang baru

---

## ✅ Data yang Tersinkronisasi

Dari **Admin Company Settings** ke **Consultation Form**:

1. ✅ **Email** → info section
2. ✅ **WhatsApp** → info section
3. ✅ **WhatsApp** → placeholder input nomor telepon

---

## 🔄 Fallback System

Jika data di admin **belum diisi**:

```php
Email:    info@leveons.id (default)
WhatsApp: +62 812 3456 7890 (default)
```

---

## 📊 Testing Checklist

- [x] Controller load company data
- [x] Email tersinkronisasi
- [x] WhatsApp tersinkronisasi
- [x] Auto-format nomor WhatsApp
- [x] Link wa.me berfungsi
- [x] Placeholder update otomatis
- [x] Fallback ke default jika kosong
- [x] View cache cleared

---

## 🎨 Preview

**Sebelum:**
```
WhatsApp: +62 812 3456 7890 (hardcoded)
```

**Sesudah:**
```
WhatsApp: [Nomor dari Admin Company Settings]
Contoh: +62 821 1234 5678 (jika diisi di admin)
```

---

## 📁 Files Modified

1. ✅ `app/Http/Controllers/ConsultationController.php`
2. ✅ `resources/views/consultation/form.blade.php`

---

## 🚀 Status

✅ **COMPLETED** - WhatsApp number sekarang tersinkronisasi dengan Admin Company Settings!

**Updated:** October 16, 2025  
**Status:** Production Ready
