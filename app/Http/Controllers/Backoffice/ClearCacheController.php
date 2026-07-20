<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ClearCacheController extends Controller
{
    /**
     * Clear all Laravel caches.
     */
    public function __invoke()
    {
        Artisan::call('optimize:clear');

        return back()->with(
            'success',
            'Application cache cleared successfully.'
        );
    }
}