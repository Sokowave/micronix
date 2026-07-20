<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function accept(Request $request)
    {
        // Lifetime = 1 year
        $minutes = 60 * 24 * 365;

        Cookie::queue(
            'cookie_consent',   // name
            true,               // value
            $minutes            // lifetime in minutes
        );

        return response()->json(['status' => 'accepted']);
    }
}
