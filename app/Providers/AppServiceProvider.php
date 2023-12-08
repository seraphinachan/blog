<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;

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
      Paginator::useBootstrapFive();
      Paginator::useBootstrapFour();

      $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
      View::share('navbar_categories', $categories);
    }
}
