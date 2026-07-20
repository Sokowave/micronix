<?php
//routes/web.php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ProductBrandController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductListingController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\ProductSearchController;
use App\Http\Controllers\Frontend\CategoriesController;
use App\Http\Controllers\PwaController;
use App\Http\Controllers\Frontend\MobileSearchController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\ImageController;




    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('/')
        ->name('frontend.')
        ->group(function () {
            Route::get('/contact-us', [ContactUsController::class, 'index'])
                ->name('contact-us');
        });

    Route::get('categories', [CategoriesController::class, 'index'])->name('frontend.categories.index');

    Route::get('/b/{slug}', [ProductBrandController::class, 'show'])->name('brand.show');

    Route::get('/search', [MobileSearchController::class, 'index'])->name('mobile.search.index');
    Route::get('/search-suggestions', [ProductSearchController::class, 'suggestions'])->name('search.suggestions');

    Route::controller(ProductListingController::class)->group(function () {

        Route::get('/products', 'index')->name('product.listing');
        Route::get('/categories/{category:slug}', 'category')->name('category.show');

    });
    Route::get('/item-details/{slug}', [ProductDetailsController::class, 'show'])->name('product.show');

    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

    Route::get('/sitemaps/general.xml', [SitemapController::class, 'general'])->name('sitemap.general');
    Route::get('/sitemaps/products.xml', [SitemapController::class, 'products'])->name('sitemap.products');
    Route::get('/sitemaps/categories.xml', [SitemapController::class, 'categories'])->name('sitemap.categories');
    Route::get('/sitemaps/help.xml', [SitemapController::class, 'help'])->name('sitemap.help');

    Route::get('/about', [AboutController::class, 'index'])->name('frontend.about');

    Route::get('/manifest.json', [PwaController::class, 'manifest'])->name('pwa.manifest');
    Route::view('/offline', 'offline')->name('offline');

    Route::post('/accept-cookies', [CookieConsentController::class, 'accept'])->name('cookies.accept');

    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');

    Route::get('/image/{path}', ImageController::class)
        ->where('path', '.*')
        ->name('image');


    require __DIR__.'/pages.php';
    require __DIR__.'/auth.php';
    require __DIR__.'/backoffice.php';
