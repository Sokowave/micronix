<?php

use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\Brands\Show as BrandShow;
use App\Livewire\Frontend\Products\Index as ProductsIndex;
use App\Livewire\Frontend\Products\Show as ProductShow;
use App\Livewire\Frontend\Collections\Index as CollectionIndex;
use App\Livewire\Frontend\Collections\Show as CollectionShow;
use App\Livewire\Frontend\SeoLandingPage\Show as SeoLandingPageShow;


use Illuminate\Support\Facades\Route;

Route::livewire('/', Home::class)->name('home');

Route::livewire('/products', ProductsIndex::class)->name('products.index');

Route::livewire('/products/{slug}', ProductShow::class)->name('products.show');

Route::livewire('/categories/{category:slug}', ProductsIndex::class)->name('categories.show');

Route::livewire('/brands/{brand:slug}', BrandShow::class)->name('brands.show');

Route::livewire('/search', ProductsIndex::class)->name('search');


Route::get('/collections', CollectionIndex::class)->name('collections.index');
Route::get('/collections/{slug}', CollectionShow::class)->name('collections.show');

Route::get('/{slug}', SeoLandingPageShow::class)->name('seo-landing-page.show');