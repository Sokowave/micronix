{{-- resources/views/partials/frontend/home/hero/tablet.blade.php --}}

@if ($heroCenter->isNotEmpty())
    <div class="hidden h-[380px] md:block lg:hidden">
        @include('partials.frontend.home.hero.banner-carousel', [
            'banners' => $heroCenter,
            'key' => 'hero-center-md',
            'alt' => 'Micronix featured promotion',
            'navigation' => true,
        ])
    </div>
@endif