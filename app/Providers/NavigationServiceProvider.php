<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View composer untuk semua view yang mungkin membutuhkan navigation
        View::composer(['layouts.frontend', 'partials.navigation', 'frontend.*'], function ($view) {
            $navigationMenus = Menu::getTreeStructure();
            
            $view->with('navigationMenus', $navigationMenus);
        });
    }
}
