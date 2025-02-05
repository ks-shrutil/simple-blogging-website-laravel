<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }


    public function boot()
    {
        Paginator::useBootstrap();
        // share categories across all views
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
