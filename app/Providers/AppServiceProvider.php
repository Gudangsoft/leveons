<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share company settings with all views
        View::composer('*', function ($view) {
            $company = Company::getSettings();
            
            $view->with('company', $company);
        });

        // Register image helper directive
        Blade::directive('image', function ($expression) {
            return "<?php echo view('components.image', $expression); ?>";
        });
    }
}
