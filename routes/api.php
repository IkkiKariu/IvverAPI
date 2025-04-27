<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return response('Hello from API!');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/add', [ProductController::class, 'store']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
});

Route::get('/test', function (Request $request) {
    return $request->query('cat');
}); 