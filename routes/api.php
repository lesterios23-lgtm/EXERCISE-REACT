<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\HumanResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index'])->name('legacy.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('legacy.products.show');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [HumanResourceController::class, 'Payroll']);
Route::post('/calculate', [HumanResourceController::class, 'Calculate']);
