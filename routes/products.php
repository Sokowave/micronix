<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\Product\ProductController;
use App\Http\Controllers\Backoffice\Product\ProductMediaController;


Route::resource('products', ProductController::class)->except(['show']);

Route::delete(
    'products/images/{id}',
    [ProductMediaController::class, 'destroy']
)->name('products.images.destroy');