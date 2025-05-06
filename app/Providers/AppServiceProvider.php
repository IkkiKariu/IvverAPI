<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\MeasurementUnitService;
use App\Services\ProductPhotoService;

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
        $this->app->bind(MeasurementUnitService::class, function () {
            return new MeasurementUnitService;
        });
        $this->app->bind(ProductPhotoService::class, function () {
            return new ProductPhotoService;
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
