<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\AuthController;

use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/', function () {
    return response('Hello from API!');
});

Route::post('/login', [AuthController::class, 'auth']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware(EnsureTokenIsValid::class);

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
    Route::middleware([EnsureTokenIsValid::class])->group(function () {
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
});

Route::post('test', function (Request $request) {
    $payload = $request->json()->all();

    $validator = Validator::make($payload, [
        'price' => ['nullable', 'decimal:2']
    ]);

    if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

    return response()->json(status: 200);
});