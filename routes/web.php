<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Frontend Routes - New Menu System
Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

// Insight Detail Routes
Route::get('/insight/{slug}', [MenuController::class, 'showInsight'])->name('insight.show');

// Whitepaper Routes
Route::get('/whitepapers', [App\Http\Controllers\WhitepaperController::class, 'index'])->name('whitepapers.index');
Route::get('/whitepapers/{whitepaper}', [App\Http\Controllers\WhitepaperController::class, 'show'])->name('whitepapers.show');
Route::get('/whitepapers/{whitepaper}/download', [App\Http\Controllers\WhitepaperController::class, 'download'])->name('whitepapers.download');

// Consultation Routes
Route::get('/consultation', [App\Http\Controllers\ConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation', [App\Http\Controllers\ConsultationController::class, 'store'])->name('consultation.store');

// Consultant Routes
Route::get('/consultants', [App\Http\Controllers\ConsultantController::class, 'index'])->name('consultants.index');
Route::get('/consultants/{slug}', [App\Http\Controllers\ConsultantController::class, 'show'])->name('consultant.show');

// Booking Routes
Route::get('/booking/{slug}/calendar', [App\Http\Controllers\BookingController::class, 'calendar'])->name('booking.calendar');
Route::get('/booking/{slug}/details', [App\Http\Controllers\BookingController::class, 'details'])->name('booking.details');
Route::post('/booking/{slug}/invoice', [App\Http\Controllers\BookingController::class, 'invoice'])->name('booking.invoice');
Route::post('/booking/{slug}/store', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{id}', [App\Http\Controllers\BookingController::class, 'confirmation'])->name('booking.confirmation');

// Legacy Frontend Routes (for backward compatibility)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Authentication Routes
Auth::routes();

// Admin Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Admin Page Management
    Route::resource('pages', AdminPageController::class);
    
    // Admin Article Management
    Route::resource('articles', AdminArticleController::class);
    
    // Admin Category Management
    Route::resource('categories', AdminCategoryController::class);
    
    // Admin Insight Management
    Route::resource('insights', App\Http\Controllers\Admin\InsightController::class);
    
    // Admin Whitepaper Management
    Route::resource('whitepapers', App\Http\Controllers\Admin\WhitepaperController::class);
    
    // Admin Consultation Requests Management
    Route::resource('consultation-requests', App\Http\Controllers\Admin\ConsultationRequestController::class)->only(['index', 'show', 'destroy']);
    
    // Admin Consultant Management
    Route::resource('consultants', App\Http\Controllers\Admin\ConsultantController::class);
    
    // Admin Consultation Packages Management
    Route::resource('packages', App\Http\Controllers\Admin\ConsultationPackageController::class)->except(['show']);
    
    // Admin CTA Sections Management
    Route::resource('cta-sections', App\Http\Controllers\Admin\CtaSectionController::class);
    
    // Admin Booking Management
    Route::get('bookings', [App\Http\Controllers\Admin\ConsultantBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{id}', [App\Http\Controllers\Admin\ConsultantBookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{id}/update-status', [App\Http\Controllers\Admin\ConsultantBookingController::class, 'updateStatus'])->name('bookings.update-status');
    Route::delete('bookings/{id}', [App\Http\Controllers\Admin\ConsultantBookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Admin Menu Management
    Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);
    Route::post('menus/clear-cache', [App\Http\Controllers\Admin\MenuController::class, 'clearCache'])->name('menus.clear-cache');
    
    // Home Hero Slider Management
    Route::resource('home-hero-sliders', App\Http\Controllers\Admin\HomeHeroSliderController::class);
    
    // Company Settings
    Route::get('company', [App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('company.index');
    Route::put('company', [App\Http\Controllers\Admin\CompanyController::class, 'update'])->name('company.update');
    
    // Cache Management
    Route::post('/cache/clear', [AdminController::class, 'clearCache'])->name('cache.clear');
});

// Fallback route untuk custom pages
Route::fallback([PageController::class, 'show']);
