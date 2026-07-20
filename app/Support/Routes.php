<?php

namespace App\Support;

class Routes
{
    public static function toArray(): array
    {
        return [
            'home' => route('home'),

            'products' => [
                'index' => route('product.listing'),
                'suggestions' => route('search.suggestions'),
            ],

            'categories' => [
                'index' => route('frontend.categories.index'),
            ],

            'backoffice' => [
                'dashboard' => route('backoffice.dashboard'),
                'products' => route('backoffice.products.index'),
                'login' => route('login'),
                'logout' => route('backoffice.logout'),
                'register' => route('register'),
            ],
        ];
    }
}