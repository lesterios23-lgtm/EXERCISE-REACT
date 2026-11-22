<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ProductController as ApiV1ProductController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Category1Controller;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthenticationController::class, 'me']);
        Route::post('/logout', [AuthenticationController::class, 'logout']);
    });
});

Route::get('/products', [ProductController::class, 'index']);
Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'store']);

Route::get('/categories', [Category1Controller::class, 'index'])->name('legacy.categories.index');
Route::get('/categories/{category}', [Category1Controller::class, 'show'])->name('legacy.categories.show');
Route::apiResource('posts', PostController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::put('/products/{product}', [ApiV1ProductController::class, 'update'])->name('legacy.products.update');
Route::patch('/products/{product}', [ApiV1ProductController::class, 'update']);
Route::delete('/products/{product}', [ApiV1ProductController::class, 'destroy'])->name('legacy.products.destroy');
Route::get('/products/{product}', [ApiV1ProductController::class, 'show'])->name('legacy.products.show');
