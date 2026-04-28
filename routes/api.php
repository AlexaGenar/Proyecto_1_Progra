<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::apiResource('categories', CategoryController::class);
Route::get('products/search', [ProductController::class, 'search']);
Route::apiResource('products', ProductController::class);