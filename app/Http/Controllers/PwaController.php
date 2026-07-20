<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class PwaController extends Controller
{
    public function manifest()
    {
        $manifest = [
            'name' => SiteSetting::get('site_name', config('app.name')),
            'pwa_short_name' => SiteSetting::get('pwa_short_name', config('app.name')),
            'start_url' => '/',
            'display' => 'standalone',
            'background_color' => SiteSetting::get('pwa_background_color', '#ffffff'),
            'theme_color' => SiteSetting::get('theme_color', '#000000'),
            'orientation' => 'portrait',
            'icons' => [],
        ];

        // Standard PWA icon sizes
        $sizes = [192, 512];

        foreach ($sizes as $size) {
            $iconPath = SiteSetting::get("icon_{$size}");
            if ($iconPath) {
                $manifest['icons'][] = [
                    'src' => $iconPath?->url,
                    'sizes' => "{$size}x{$size}",
                    'type' => 'image/png',
                    'purpose' => in_array($size, [192, 512]) ? 'any maskable' : 'any',
                ];
            }
        }

        return response()->json(
            $manifest,
            200,
            ['Content-Type' => 'application/manifest+json'],
            JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );
    }

    
}
