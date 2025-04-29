<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return response('Hello from API!');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
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
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/show/{id}', [CategoryController::class, 'show']);
        Route::post('/add', [CategoryController::class, 'store']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
    });
});

Route::get('/test', function (Request $request) {
    return $request->query('cat');
});