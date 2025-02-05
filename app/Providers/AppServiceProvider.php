<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Add this line
use App\Models\Category; // ✅ Make sure to import the Category model

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


    public function boot()
    {
        // Share categories across all views
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
