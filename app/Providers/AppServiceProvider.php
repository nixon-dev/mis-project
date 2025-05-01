<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        Blade::directive('truncate', function ($expression) {
            return "<?php echo Str::limit($expression, 20, '...'); ?>";
        });

        Blade::directive('shorten', function ($expression) {
            return "<?php
                \$__params = explode(',', $expression);
                \$__text = trim(\$__params[0]);
                \$__limit = isset(\$__params[1]) ? trim(\$__params[1]) : 50;
                echo Str::limit(\$__text, \$__limit);
            ?>";
        });
    }


}