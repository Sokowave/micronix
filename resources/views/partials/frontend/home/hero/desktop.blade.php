{{-- resources/views/partials/frontend/home/hero/desktop.blade.php --}}

<div class="hidden h-[380px] gap-2 lg:flex xl:hidden">

    @if ($heroLeft->isNotEmpty())
        <div class="h-full w-[248px] shrink-0">
            @include('partials.frontend.home.hero.banner-carousel', [
                'banners' => $heroLeft,
                'key' => 'hero-left-lg',
            ])
        </div>
    @endif

    @if ($heroCenter->isNotEmpty())
        <div class="h-full min-w-0 flex-1">
            @include('partials.frontend.home.hero.banner-carousel', [
                'banners' => $heroCenter,
                'key' => 'hero-center-lg',
                'alt' => 'Micronix featured promotion',
                'navigation' => true,
            ])
        </div>
    @endif

</div>