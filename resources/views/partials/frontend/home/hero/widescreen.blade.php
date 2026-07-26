{{-- resources/views/partials/frontend/home/hero/widescreen.blade.php --}}

<div class="hidden h-[380px] gap-2 xl:flex">

    @if ($heroLeft->isNotEmpty())
        <div class="h-full w-[248px] shrink-0">
            @include('partials.frontend.home.hero.banner-carousel', [
                'banners' => $heroLeft,
                'key' => 'hero-left-xl',
            ])
        </div>
    @endif

    @if ($heroCenter->isNotEmpty())
        <div class="h-full min-w-0 flex-1">
            @include('partials.frontend.home.hero.banner-carousel', [
                'banners' => $heroCenter,
                'key' => 'hero-center-xl',
                'alt' => 'Micronix featured promotion',
                'navigation' => true,
            ])
        </div>
    @endif

    @if ($heroRight->isNotEmpty())
        <div class="h-full w-[248px] shrink-0">
            @include('partials.frontend.home.hero.banner-carousel', [
                'banners' => $heroRight,
                'key' => 'hero-right-xl',
            ])
        </div>
    @endif

</div>