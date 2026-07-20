<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/privacy-policy', 'show')
        ->defaults('slug', 'privacy-policy')
        ->name('privacy-policy');

    Route::get('/terms-and-conditions', 'show')
        ->defaults('slug', 'terms-and-conditions')
        ->name('terms-and-conditions');

    Route::get('/shipping-policy', 'show')
        ->defaults('slug', 'shipping-policy')
        ->name('shipping-policy');

    Route::get('/returns-refunds', 'show')
        ->defaults('slug', 'returns-refunds')
        ->name('returns-refunds');

    Route::get('/warranty-information', 'show')
        ->defaults('slug', 'warranty-information')
        ->name('warranty-information');
});