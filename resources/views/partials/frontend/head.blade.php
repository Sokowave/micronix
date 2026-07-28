


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $seoTitle = $title ?? config('app.name', 'Micronix');

            $seoDescription = $description
                ?? 'Shop computers, laptops, phones, accessories, cameras and electronics at Micronix Kenya.';

            $seoImage = $image ?? asset('images/og-default.jpg');

            $seoUrl = $canonical ?? url()->current();

            $seoType = $type ?? 'website';

            $seoRobots = $robots ?? 'index, follow';
        @endphp

        <title>{{ $seoTitle }}</title>

        <meta name="description" content="{{ $seoDescription }}">
        <meta name="robots" content="{{ $seoRobots }}">

        <link rel="canonical" href="{{ $seoUrl }}">

        <meta property="og:site_name" content="{{ config('app.name', 'Micronix') }}">
        <meta property="og:title" content="{{ $seoTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:type" content="{{ $seoType }}">
        <meta property="og:url" content="{{ $seoUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">
        <meta property="og:locale" content="en_KE">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seoTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

            @fonts
            

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxAppearance

        @if (! empty($schema))
            <script type="application/ld+json">
                {!! json_encode(
                    $schema,
                    JSON_UNESCAPED_SLASHES
                    | JSON_UNESCAPED_UNICODE
                    | JSON_PRETTY_PRINT
                ) !!}
            </script>
        @endif