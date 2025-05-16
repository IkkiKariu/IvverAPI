<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

use App\Models\PersonalAccessToken;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\MeasurementUnitService;
use App\Services\ProductPhotoService;
use App\Services\AuthService;

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
        $this->app->bind(AuthService::class, function () {
            return new AuthService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
