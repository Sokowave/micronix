<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    /**
     * Display the Contact Us page.
     */
    public function index(): View
    {
        return view('frontend.contact-us.index');
    }
}