<?php

use App\Livewire\Backoffice\Banners\Index as BannersIndex;
use App\Livewire\Backoffice\Brands\Index as BrandsIndex;
use App\Livewire\Backoffice\Categories\Index as CategoriesIndex;
use App\Livewire\Backoffice\Dashboard;
use App\Livewire\Backoffice\Media\Index as MediaIndex;
use App\Livewire\Backoffice\Products\Create as ProductCreate;
use App\Livewire\Backoffice\Products\Edit as ProductEdit;
use App\Livewire\Backoffice\Products\Index as ProductsIndex;
use App\Livewire\Backoffice\Specifications\Index as SpecificationsIndex;
use App\Livewire\Backoffice\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'backoffice'])->prefix('dashboard')->name('backoffice.')->group(function () {
    Route::livewire('/', Dashboard::class)->name('dashboard');

    Route::livewire('/products', ProductsIndex::class)->name('products.index');
    Route::livewire('/products/create', ProductCreate::class)->name('products.create');
    Route::livewire('/products/{product}/edit', ProductEdit::class)->name('products.edit');

    Route::livewire('/categories', CategoriesIndex::class)->name('categories.index');
    Route::livewire('/brands', BrandsIndex::class)->name('brands.index');
    Route::livewire('/specifications', SpecificationsIndex::class)->name('specifications.index');
    Route::livewire('/banners', BannersIndex::class)->name('banners.index');
    Route::livewire('/media', MediaIndex::class)->name('media.index');
    Route::livewire('/users', UsersIndex::class)->name('users.index');
});