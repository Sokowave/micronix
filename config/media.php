<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Settings
    |--------------------------------------------------------------------------
    */

    'default_format' => env('MEDIA_DEFAULT_FORMAT', 'webp'),

    'default_quality' => (int) env('MEDIA_DEFAULT_QUALITY', 85),

    'optimize' => env('MEDIA_OPTIMIZE', true),

    /*
    |--------------------------------------------------------------------------
    | Extensions To Skip
    |--------------------------------------------------------------------------
    */

    'excluded_extensions' => [
        'svg',
        'gif',
        'ico',
    ],

    /*
    |--------------------------------------------------------------------------
    | Temporary Directory
    |--------------------------------------------------------------------------
    */

    'temporary_directory' => storage_path('app/temp/media'),

    /*
    |--------------------------------------------------------------------------
    | Image Profiles
    |--------------------------------------------------------------------------
    |
    | width
    | height
    | format
    | quality
    | upscale
    |
    | fit
    | contain  -> keep aspect ratio inside the box
    | cover    -> crop to fill
    | stretch  -> force resize
    |
    | canvas
    | Whether to place the image on a fixed canvas.
    |
    | background
    | Canvas background color.
    |
    | position
    | center
    | top
    | bottom
    | left
    | right
    | top-left
    | top-right
    | bottom-left
    | bottom-right
    |
    */

    'profiles' => [

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        'products' => [

            'width' => 600,

            'height' => 600,

            'fit' => 'contain',

            'canvas' => true,

            'background' => '#ffffff',

            'position' => 'center',

            'format' => 'webp',

            'quality' => 85,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        'categories' => [

            'width' => 500,

            'height' => 500,

            'fit' => 'contain',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 85,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        'brands' => [

            'width' => 300,

            'height' => 300,

            'fit' => 'contain',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 90,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Avatars
        |--------------------------------------------------------------------------
        */

        'avatars' => [

            'width' => 200,

            'height' => 200,

            'fit' => 'cover',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 90,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Banners
        |--------------------------------------------------------------------------
        */

        'banners' => [

            'width' => 1920,

            'height' => 800,

            'fit' => 'cover',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 90,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Blog
        |--------------------------------------------------------------------------
        */

        'blog' => [

            'width' => 1200,

            'height' => 630,

            'fit' => 'cover',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 90,

            'upscale' => false,

            'optimize' => true,

        ],

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */

        'pages' => [

            'width' => 1600,

            'height' => 1200,

            'fit' => 'contain',

            'canvas' => false,

            'format' => 'webp',

            'quality' => 90,

            'upscale' => false,

            'optimize' => true,

        ],

        'site-assets' => [

        'width' => null,

        'height' => null,

        'fit' => null,

        'canvas' => false,

        'format' => 'webp',

        'quality' => 95,

        'upscale' => false,

        'optimize' => true,

    ],

        
       

    ],

];