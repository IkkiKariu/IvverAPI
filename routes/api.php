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
    Route::get('/show/{id}', [ProductController::class, 'show']);
});

Route::prefix('measurement-units')->group(function () {
    Route::get('/', [MeasurementUnitController::class, 'index']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
});

Route::prefix('admin')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/add', [ProductController::class, 'store']);
        Route::get('/show/{id}', [ProductController::class, 'show']);
        Route::patch('/update/{id}', [ProductController::class, 'update']);
        Route::post('/photos/upload-all/{productId}', [ProductPhotoController::class, 'storeAll']);
        Route::post('/photos/upload-preview/{productId}', [ProductPhotoController::class, 'storePreview']);
        Route::post('/photos/upload/{productId}', [ProductPhotoController::class, 'store']);
        Route::delete('/photos/delete', [ProductPhotoController::class, 'delete']);
    });
    
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/show/{id}', [CategoryController::class, 'show']);
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
    });

    Route::prefix('measurement-units')->group(function () {
        Route::get('/', [MeasurementUnitController::class, 'index']);
        Route::post('/add', [MeasurementUnitController::class, 'store']);
        Route::delete('/delete/{id}', [MeasurementUnitController::class, 'destroy']);
    });
});