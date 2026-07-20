<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\BackofficeAuthController;
use App\Http\Controllers\Auth\PasswordResetController;

Route::prefix('kasio-center')->name('backoffice.')->group(function () {

    Route::middleware('guest:web')->group(function () {

        Route::get('login', [BackofficeAuthController::class, 'showLoginForm'])
            ->name('login');

        Route::post('login', [BackofficeAuthController::class, 'login'])
            ->name('login.submit');

        Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])
            ->name('password.email');

        Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
            ->name('password.reset');

        Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])
            ->name('password.update');
    });

    Route::middleware(['auth:web', 'backoffice'])->group(function () {
        Route::post('logout', [BackofficeAuthController::class, 'logout'])
            ->name('logout');
    });
});