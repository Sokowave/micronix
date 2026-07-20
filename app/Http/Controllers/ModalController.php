<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ModalController extends Controller
{
    /**
     * Handle newsletter modal dismissal
     */
    public function dismiss(Request $request)
    {
        // Only allow 6 months or 1 year
        $minutes = $request->input('duration') === '1_year'
            ? 60 * 24 * 365        // 1 year
            : 60 * 24 * 30 * 6;    // 6 months (default)

        // Create cookie
        $cookie = cookie('newsletter_modal_closed', true, $minutes);

        return response()->json(['status' => 'ok'])->cookie($cookie);
    }
}
