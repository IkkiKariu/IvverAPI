<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ProductService;
use App\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductService::class, function () {
            return new ProductService;
        });
        $this->app->bind(CategoryService::class, function () {
            return new CategoryService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
