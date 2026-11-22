<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Category1Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [Category1Controller::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [Category1Controller::class, 'show'])->name('categories.show');
Route::get('/category1s', [Category1Controller::class, 'index']);
Route::get('/products/queries', [ProductController::class, 'queries']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
