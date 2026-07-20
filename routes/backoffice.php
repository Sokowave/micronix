<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\BrandController;
use App\Http\Controllers\Backoffice\CategoryController;

use App\Http\Controllers\Backoffice\SiteSettingsController;
use App\Http\Controllers\Backoffice\BannerController;
use App\Http\Controllers\Backoffice\PageController;

use App\Http\Controllers\Backoffice\BannerLocationController;
use App\Http\Controllers\Backoffice\StaffController;
use App\Http\Controllers\Backoffice\ClearCacheController;
use App\Http\Controllers\Backoffice\TestimonialController;



Route::prefix('dashboard')->name('backoffice.')->middleware([
    'auth',
    'backoffice'
    ])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');


    Route::resource('categories', CategoryController::class);
    Route::resource('testimonials', TestimonialController::class);
    

    Route::resource('banner-locations', BannerLocationController::class)
            ->only(['index', 'store', 'update', 'destroy']);


    Route::prefix('site-settings')->name('site-settings.')->group(function () {
        Route::get('{section}', [SiteSettingsController::class, 'edit'])->name('edit');
        Route::post('{section}', [SiteSettingsController::class, 'update'])->name('update');
        Route::post('test-mail', [SiteSettingsController::class, 'testMail'])->name('test-mail');
    });


    Route::resource('banners', BannerController::class)->except(['show']);

    Route::resource('pages', PageController::class);

    Route::resource('staff', StaffController::class);

    Route::post('clear-cache', ClearCacheController::class)
    ->name('clear-cache');

    require __DIR__.'/products.php';


});

