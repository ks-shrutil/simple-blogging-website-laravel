<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\User;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];
    
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
