<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');

        return view('frontend.about.index', compact('settings'));
    }
}