<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\ProductPhotoController;

Route::get('/', function () {
    return response('Hello from API!');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::prefix('measurement-units')->group(function () {
    Route::get('/', [MeasurementUnitController::class, 'index']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});

Route::prefix('admin')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/add', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::patch('/{id}/update', [ProductController::class, 'update']);
        
        Route::post('/{id}/photos/upload-all', [ProductPhotoController::class, 'storeAll']);
        Route::post('/{id}/photos/upload-preview', [ProductPhotoController::class, 'storePreview']);
        Route::post('/{id}/photos/upload', [ProductPhotoController::class, 'store']);
        Route::delete('/photos/delete', [ProductPhotoController::class, 'delete']);
    });
    
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/{id}/update', [CategoryController::class, 'update']);
    });

    Route::prefix('measurement-units')->group(function () {
        Route::get('/', [MeasurementUnitController::class, 'index']);
        Route::post('/add', [MeasurementUnitController::class, 'store']);
        Route::delete('/{id}/delete', [MeasurementUnitController::class, 'destroy']);
    });
});