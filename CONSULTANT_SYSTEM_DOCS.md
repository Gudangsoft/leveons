# Consultant Management System - Documentation

## 📋 Overview

Complete CRUD system for managing consultants with admin panel and frontend profile pages. Includes consultant listing page with yellow cards matching the design from the screenshot.

---

## ✅ Implementation Summary

### 1. **Database & Model**
- ✅ Migration: `2025_10_14_120000_create_consultants_table.php`
- ✅ Model: `app/Models/Consultant.php`
- ✅ Seeder: `database/seeders/ConsultantSeeder.php`

**Fields:**
- `id` - Primary key
- `name` - Consultant name
- `slug` - URL-friendly slug (auto-generated)
- `title` - Position/title (e.g., "CEO", "Manager")
- `company` - Company name
- `price_text` - Display price (e.g., "Start from Rp 1.5 jt")
- `avatar` - Profile image (nullable, stored in `storage/consultants/`)
- `bio` - Biography text
- `is_published` - Published status (boolean)
- `timestamps` - created_at, updated_at

---

### 2. **Admin Panel (Protected Routes)**

#### Controller:
📁 `app/Http/Controllers/Admin/ConsultantController.php`

**Methods:**
- `index()` - List all consultants with pagination
- `create()` - Show create form
- `store()` - Save new consultant
- `show()` - View consultant details
- `edit()` - Show edit form
- `update()` - Update consultant
- `destroy()` - Delete consultant

#### Views:
📁 `resources/views/admin/consultants/`
- ✅ `index.blade.php` - List view with actions
- ✅ `create.blade.php` - Create form with image upload
- ✅ `edit.blade.php` - Edit form with current data
- ✅ `show.blade.php` - Detail view with delete option

#### Routes:
```php
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('consultants', App\Http\Controllers\Admin\ConsultantController::class);
});
```

**Admin URLs:**
- `/admin/consultants` - List
- `/admin/consultants/create` - Create
- `/admin/consultants/{id}` - View
- `/admin/consultants/{id}/edit` - Edit

---

### 3. **Frontend (Public Routes)**

#### Controller:
📁 `app/Http/Controllers/ConsultantController.php`

**Methods:**
- `index()` - List published consultants
- `show($slug)` - Show consultant profile

#### Views:
📁 `resources/views/frontend/consultants/`
- ✅ `index.blade.php` - Consultant listing with yellow cards
📁 `resources/views/frontend/consultant/`
- ✅ `show.blade.php` - Individual consultant profile page

#### Routes:
```php
Route::get('/consultants', [ConsultantController::class, 'index'])->name('consultants.index');
Route::get('/consultants/{slug}', [ConsultantController::class, 'show'])->name('consultant.show');
```

**Frontend URLs:**
- `/consultants` - Consultant listing page
- `/consultants/{slug}` - Individual profile (e.g., `/consultants/dedy-sidarta`)

---

## 🎨 Design Features

### Consultant Listing Page (`/consultants`)

**Yellow Card Design:**
- Background: `#FED31A` (brand yellow)
- Border radius: 20px
- Hover effect: Lifts up 10px with shadow
- Layout: 2 columns (responsive to 1 column on mobile)

**Card Content:**
- Circular avatar (150x150px) with white border
- Consultant name (bold, 1.3rem)
- Title/Position
- Company name
- Price text
- "Lihat Profil" button (blue, rounded)

**Features:**
- Responsive grid layout
- Smooth hover animations
- Professional typography
- CTA section at bottom

### Consultant Profile Page (`/consultants/{slug}`)

**Hero Section:**
- Yellow gradient background
- Large circular avatar (200x200px)
- White border with shadow

**Profile Card:**
- White card with shadow
- Centered layout (col-lg-10)
- Name, title, company display
- Price highlight with icon
- Biography section
- Info cards for experience & expertise
- Call-to-action buttons (Konsultasi & WhatsApp)

**Related Services:**
- 3-card grid showing services
- Icons for Marketing, Business Advisory, Academy
- Clean card design with hover effects

---

## 📊 Sample Data (Seeded)

4 consultants populated from `ConsultantSeeder`:

1. **Dedy Sidarta, BKP, CFP, PFM.**
   - CEO D'Consulting
   - Start from Rp 1.5 jt

2. **Rio Kristiantoro, SE, BKP.**
   - Manager D'Consulting
   - Start from Rp 1 jt

3. **Alif Imraan Muhammed**
   - Senior Executive Consultant
   - Start from Rp 500 rb

4. **Alviana D. Insani**
   - Senior Executive Consultant
   - Start from Rp 500 rb

---

## 🔧 Admin Features

### Image Upload:
- ✅ Live preview before upload
- ✅ File validation (JPG, PNG, WEBP, max 2MB)
- ✅ Stored in `storage/app/public/consultants/`
- ✅ Auto-delete old images on update

### Slug Management:
- ✅ Auto-generated from name
- ✅ Manual override option
- ✅ Real-time preview in create/edit forms
- ✅ Unique validation

### Publishing:
- ✅ Toggle published/draft status
- ✅ Only published consultants shown on frontend
- ✅ Draft badge in admin list
- ✅ "View Profile" link only for published

### Form Features:
- ✅ Client-side validation
- ✅ Server-side validation with error messages
- ✅ Old input preservation on errors
- ✅ Success/error flash messages
- ✅ Cancel/back buttons

---

## 🚀 Usage Guide

### Adding New Consultant (Admin):

1. Login to admin panel (`/admin`)
2. Navigate to "Consultants" in sidebar
3. Click "Tambah Consultant"
4. Fill in the form:
   - Name (required)
   - Slug (auto-generated or custom)
   - Title/Position
   - Company
   - Price Text
   - Upload Avatar (optional)
   - Bio
   - Check "Published" to make visible
5. Click "Save Consultant"

### Viewing Consultants (Frontend):

**Listing Page:**
- Visit `/consultants`
- Browse all published consultants
- Click "Lihat Profil" on any consultant

**Profile Page:**
- View consultant details
- See bio and expertise
- Contact via "Mulai Konsultasi" or WhatsApp

---

## 📁 File Structure

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   └── ConsultantController.php    # Admin CRUD
│   └── ConsultantController.php        # Frontend controller
├── Models/
│   └── Consultant.php                  # Model with auto-slug

database/
├── migrations/
│   └── 2025_10_14_120000_create_consultants_table.php
└── seeders/
    └── ConsultantSeeder.php            # Sample data

resources/views/
├── admin/consultants/
│   ├── index.blade.php                 # Admin list
│   ├── create.blade.php                # Admin create
│   ├── edit.blade.php                  # Admin edit
│   └── show.blade.php                  # Admin view
└── frontend/
    ├── consultants/
    │   └── index.blade.php             # Public listing
    └── consultant/
        └── show.blade.php              # Public profile

routes/
└── web.php                             # Routes registration

storage/
└── app/public/consultants/             # Avatar uploads
```

---

## 🎯 Key Features

### Security:
- ✅ Admin routes protected by auth middleware
- ✅ Only published consultants visible publicly
- ✅ File upload validation
- ✅ CSRF protection on forms
- ✅ SQL injection prevention (Eloquent ORM)

### UX/UI:
- ✅ Responsive design (mobile-first)
- ✅ Smooth animations and transitions
- ✅ Professional color scheme
- ✅ Intuitive navigation
- ✅ Clear CTAs

### SEO:
- ✅ Unique slugs for URLs
- ✅ Meta descriptions
- ✅ Semantic HTML
- ✅ Alt tags on images

---

## 🔗 Integration Points

### With Existing System:
- ✅ Uses `Company::getSettings()` for company info
- ✅ Links to `/consultation` form
- ✅ WhatsApp integration from company settings
- ✅ Follows existing admin layout (`layouts.admin`)
- ✅ Follows existing frontend layout (`layouts.frontend`)

### Navigation:
You can add a menu link to consultants page in your menu system:
- URL: `/consultants`
- Title: "Konsultasi Online" or "Our Consultants"

---

## 📈 Future Enhancements (Optional)

- [ ] Add categories/specializations for consultants
- [ ] Add ratings/reviews system
- [ ] Add booking/appointment scheduling
- [ ] Add consultant availability calendar
- [ ] Add search and filter on listing page
- [ ] Add social media links for consultants
- [ ] Add consultant statistics/achievements
- [ ] Add multiple images gallery per consultant

---

## 🐛 Troubleshooting

### Images not showing:
```bash
php artisan storage:link
```

### Routes not working:
```bash
php artisan route:clear
php artisan route:cache
```

### Views not updating:
```bash
php artisan view:clear
```

### Database issues:
```bash
php artisan migrate:fresh --seed
```

---

## ✅ Testing Checklist

- [x] Migration runs successfully
- [x] Seeder populates sample data
- [x] Admin can create consultant
- [x] Admin can upload avatar
- [x] Admin can edit consultant
- [x] Admin can delete consultant
- [x] Slug auto-generates from name
- [x] Published toggle works
- [x] Frontend listing shows consultants
- [x] "Lihat Profil" button works
- [x] Profile page displays correctly
- [x] Responsive on mobile
- [x] Images display properly
- [x] Links work (consultation, WhatsApp)

---

## 📞 Support & Maintenance

**Files to update** when modifying:
- Model validation: `app/Models/Consultant.php`
- Admin logic: `app/Http/Controllers/Admin/ConsultantController.php`
- Frontend logic: `app/Http/Controllers/ConsultantController.php`
- Admin views: `resources/views/admin/consultants/*.blade.php`
- Frontend views: `resources/views/frontend/consultant*.blade.php`

**Database changes:**
Create new migration with:
```bash
php artisan make:migration add_field_to_consultants_table
```

---

**Last Updated**: October 14, 2025  
**Version**: 1.0  
**Status**: ✅ Fully Implemented  
**Type**: Complete CRUD System
