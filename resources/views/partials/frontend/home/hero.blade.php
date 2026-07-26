{{-- resources/views/partials/frontend/home/hero.blade.php --}}

<section class="py-4">
    <div class="mx-auto max-w-7xl px-2 xl:px-6">

        {{-- Mobile --}}
        @include('partials.frontend.home.hero.mobile')

        {{-- Tablet --}}
        @include('partials.frontend.home.hero.tablet')

        {{-- Desktop --}}
        @include('partials.frontend.home.hero.desktop')

        {{-- Widescreen --}}
        @include('partials.frontend.home.hero.widescreen')

    </div>
</section>