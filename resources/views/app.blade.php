<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (() => {
                const appearance = '{{ $appearance ?? "system" }}';

                if (
                    appearance === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches
                ) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>

        {{-- Inline style to prevent flash of incorrect background --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        {{-- Application Icons --}}
        @if($settings->site_icon)
            <link rel="icon" type="image/png" href="{{ $settings->site_icon->url }}">
        @endif

        @if($settings->apple_touch_icon)
            <link
                rel="apple-touch-icon"
                href="{{ $settings->apple_touch_icon->url }}"
            >
        @endif

        {{-- Theme --}}
        <meta
            name="theme-color"
            content="{{ $settings->theme_color }}"
        >

        @fonts

        @vite([
            'resources/css/app.css',
            'resources/js/app.ts',
            "resources/js/pages/{$page['component']}.vue",
        ])

        <x-inertia::head>
            <title>{{ $settings->site_name }}</title>
        </x-inertia::head>
    </head>

    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>