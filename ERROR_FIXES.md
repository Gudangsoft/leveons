# Error Fixed - Dual Package System Support

## Problem
**Error:** 500 Internal Server Error  
**URL:** `/booking/bagus-sudirman/details?date=2025-10-22&time=10%3A00&package=0`  
**Location:** `app/Http/Controllers/BookingController.php:60`

**Error Message:**
```
Trying to access array offset on value of type null
$selectedPackage = $consultant->consultation_packages[$packageIndex] ?? ...
```

## Root Cause
The booking system was trying to access `consultation_packages` as a JSON array, but the system now supports:
1. **Database packages** (from `consultation_packages` table)
2. **JSON packages** (legacy, from `consultation_packages` column in consultants table)

When a consultant has packages in the database but the code was still accessing JSON array, it caused a null pointer error.

## Solution
Updated **BookingController** and all booking views to support **dual package system**:

### Files Modified:

#### 1. `app/Http/Controllers/BookingController.php`
**Changes:**
- Added `->with('packages')` to all Consultant queries
- Detect package source: `$packagesFromDB = $consultant->packages->count() > 0`
- Get packages from appropriate source: `$packages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? [])`
- Handle package data extraction for both objects (DB) and arrays (JSON)

**Methods Updated:**
- ✅ `calendar()` - Support dual packages
- ✅ `details()` - Support dual packages  
- ✅ `invoice()` - Support dual packages
- ✅ `store()` - Support dual packages, extract data based on source

#### 2. `resources/views/frontend/booking/calendar.blade.php`
**Changes:**
- Added PHP block to detect if `$selectedPackage` is object or array
- Extract data: `$packageName`, `$packageDuration`, `$packagePlatform`, `$packagePriceDisplay`
- Use extracted variables in display

#### 3. `resources/views/frontend/booking/details.blade.php`
**Changes:**
- Check `$packagesFromDB` variable from controller
- Extract package data conditionally based on source
- Use ternary operator: `isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->name : $selectedPackage['name']`

#### 4. `resources/views/frontend/booking/invoice.blade.php`
**Changes:**
- Similar to details view
- Extract package data based on `$packagesFromDB` flag
- Display extracted variables

## Testing
```bash
# Clear cache
php artisan view:clear
php artisan cache:clear

# Test URLs:
# 1. Consultant with database packages
/booking/{slug}/calendar?event=30min&package=0

# 2. Consultant with JSON packages (legacy)
/booking/{slug}/calendar?event=30min&package=0

# Both should work without errors
```

## Backward Compatibility
✅ **Fully backward compatible**
- Consultants with JSON packages (old) still work
- Consultants with database packages (new) work
- System automatically detects and uses correct source

## Migration Path
To migrate existing consultants from JSON to database:

```php
// Create seeder or artisan command
foreach (Consultant::all() as $consultant) {
    if ($consultant->consultation_packages) {
        foreach ($consultant->consultation_packages as $index => $package) {
            ConsultationPackage::create([
                'consultant_id' => $consultant->id,
                'name' => $package['name'],
                'duration' => $package['duration'],
                'price' => extractPrice($package['price_display']),
                'price_display' => $package['price_display'],
                'description' => $package['description'] ?? '',
                'platform' => $package['platform'] ?? 'Google Meet',
                'order' => $index + 1,
                'is_active' => true,
                'is_popular' => $index === 0,
            ]);
        }
    }
}
```

## Status
✅ **FIXED** - Error resolved, system now supports both package storage methods.

**Date Fixed:** October 16, 2025  
**Fixed by:** AI Assistant
