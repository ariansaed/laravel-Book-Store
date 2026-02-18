<?php

namespace App\Providers;

use App\Models\category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            $categories = cache()->remember('categories', 3600, function () {
                return category::orderBy('name')->get();
            });
            $view->with('categories', $categories);
        });
    }
}
