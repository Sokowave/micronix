{{-- resources/views/components/layouts/frontend/app.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.frontend.head')
    </head>

    <body class="min-h-screen bg-white text-zinc-900 antialiased">
        <div class="flex min-h-screen flex-col">
            <x-frontend.header />

            {{ $slot }}

            <x-frontend.footer />
        </div>

        @fluxScripts
    </body>
</html>