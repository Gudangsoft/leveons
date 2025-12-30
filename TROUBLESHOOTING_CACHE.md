# Troubleshooting - Cache & Layout Issues

## 🔍 Problem
Tampilan website masih menampilkan layout lama setelah perubahan code.

## ✅ Solution Steps

### 1. **Clear Laravel Cache**
```bash
# Clear all Laravel caches
php artisan optimize:clear

# Or clear individually:
php artisan cache:clear        # Application cache
php artisan view:clear         # Compiled Blade views
php artisan config:clear       # Configuration cache
php artisan route:clear        # Route cache
```

### 2. **Clear Browser Cache**

#### Chrome / Edge:
- **Windows**: `Ctrl + Shift + Delete` atau `Ctrl + Shift + R` (hard refresh)
- **Mac**: `Cmd + Shift + Delete` atau `Cmd + Shift + R`

#### Firefox:
- **Windows**: `Ctrl + Shift + Delete` atau `Ctrl + F5` (force reload)
- **Mac**: `Cmd + Shift + Delete` atau `Cmd + Shift + R`

#### Safari:
- **Mac**: `Cmd + Option + E` (clear cache) kemudian `Cmd + R` (reload)

### 3. **Force Refresh in Browser**
```
Method 1: Hard Refresh
- Chrome/Edge: Ctrl + Shift + R
- Firefox: Ctrl + F5
- Safari: Cmd + Option + R

Method 2: Clear Cache untuk Site Spesifik
- Chrome: F12 → Network tab → Check "Disable cache" → Refresh
- Firefox: F12 → Network → Check "Disable HTTP Cache"
```

### 4. **Check Dev Tools**
```
1. Buka Developer Tools (F12)
2. Go to Network tab
3. Check "Disable cache"
4. Reload page (F5)
5. Lihat apakah file CSS/JS ter-reload
```

### 5. **Clear Public Assets**
```bash
# Jika menggunakan Laravel Mix / Vite
npm run build

# Or development
npm run dev
```

### 6. **Restart Laravel Server**
```bash
# Stop server (Ctrl + C di terminal)
# Start lagi
php artisan serve
```

## 🎯 Expected Result After Cache Clear

### Before (Old Layout):
```
┌─────────────────────────────────────────┐
│  [Text Full Width]  [Image on Right]    │
│  No white box, no centering             │
└─────────────────────────────────────────┘
```

### After (New Centered Layout):
```
        ┌───────────────────────────┐
        │  ┌─────────┬─────────┐   │
        │  │  Text   │  Image  │   │  ← White Box
        │  │  (50%)  │  (50%)  │   │  ← Centered
        │  └─────────┴─────────┘   │
        └───────────────────────────┘
```

## 📋 Verification Checklist

- [ ] Laravel cache cleared (optimize:clear)
- [ ] Browser hard refresh (Ctrl + Shift + R)
- [ ] Developer Tools cache disabled
- [ ] Server restarted
- [ ] Page loaded without cache
- [ ] White box wrapper visible
- [ ] Content centered on page
- [ ] Text and image split 50-50

## 🔧 Additional Debugging

### Check if File is Cached:
```bash
# Check compiled view file
ls -la storage/framework/views/

# Delete all compiled views manually
rm -rf storage/framework/views/*
```

### Check Browser Network Tab:
```
1. F12 → Network
2. Reload page
3. Find home.blade.php or home route
4. Check "Status" column:
   - 200: Fresh from server ✅
   - 304: From cache ❌ (need hard refresh)
```

### Verify Changes in Code:
```bash
# Check if changes are saved
cat resources/views/frontend/home.blade.php | grep "col-lg-11"
# Should return: <div class="col-lg-11">

cat resources/views/frontend/home.blade.php | grep "justify-content-center"
# Should return: <div class="row justify-content-center">
```

## 💡 Prevention Tips

### Development Settings:
```env
# In .env file
APP_ENV=local
APP_DEBUG=true

# Browser Developer Tools:
- Always enable "Disable cache" during development
- Use Incognito/Private mode for testing
```

### Browser Extensions:
Install extension untuk auto-clear cache:
- **Chrome**: Clear Cache extension
- **Firefox**: Clear Cache button

### IDE Settings (VS Code):
```json
// settings.json
{
  "php.validate.executablePath": "C:/php/php.exe",
  "blade.format.enable": true,
  "files.autoSave": "afterDelay",
  "files.autoSaveDelay": 1000
}
```

## 🚨 Common Issues

### Issue 1: Changes not visible after cache clear
**Cause**: Browser still using cached version
**Fix**: Use Incognito/Private browsing mode

### Issue 2: 500 Error after cache clear
**Cause**: Config cache corruption
**Fix**: 
```bash
php artisan config:clear
php artisan config:cache
```

### Issue 3: CSS not loading
**Cause**: Asset compilation issue
**Fix**:
```bash
npm run build
# or
npm run dev
```

### Issue 4: View compilation error
**Cause**: Blade syntax error
**Fix**: Check Laravel log
```bash
tail -f storage/logs/laravel.log
```

## 📊 Cache Locations

### Laravel Cache:
- Application: `storage/framework/cache/`
- Views: `storage/framework/views/`
- Config: `bootstrap/cache/config.php`
- Routes: `bootstrap/cache/routes-v7.php`

### Browser Cache:
- **Chrome**: `%LocalAppData%\Google\Chrome\User Data\Default\Cache`
- **Firefox**: `%AppData%\Mozilla\Firefox\Profiles\`
- **Edge**: `%LocalAppData%\Microsoft\Edge\User Data\Default\Cache`

## ✅ Final Verification

After clearing all caches, you should see:

1. **White box wrapper** dengan shadow
2. **Centered layout** (not full width)
3. **Equal columns** (50% text, 50% image)
4. **Better typography** (2.8rem title)
5. **Proper spacing** (padding 60px 50px)

---

**Last Updated**: October 14, 2025  
**Status**: ✅ All caches cleared  
**Next Step**: Hard refresh browser (Ctrl + Shift + R)
