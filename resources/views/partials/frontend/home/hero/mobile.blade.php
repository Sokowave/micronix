{{-- resources/views/partials/frontend/home/hero/mobile.blade.php --}}

@php
    $mobileBanners = $heroLeft
        ->concat($heroRight)
        ->values();
@endphp

@if ($mobileBanners->isNotEmpty())
    <div
        class="
            -mx-4 flex snap-x snap-mandatory gap-3
            overflow-x-auto px-4
            [scrollbar-width:none]
            [&::-webkit-scrollbar]:hidden
            md:hidden
        "
    >
        @foreach ($mobileBanners as $banner)
            <a
                href="{{ $banner->url ?: '#' }}"
                wire:navigate
                wire:key="hero-mobile-{{ $banner->id }}"
                class="
                    block h-[380px] w-[248px]
                    shrink-0 snap-start
                    overflow-hidden rounded
                    bg-zinc-100
                "
            >
                @if ($banner->media)
                    <img
                        src="{{ \App\Support\MediaUrl::get($banner->media) }}"
                        alt="{{ $banner->title ?? 'Micronix promotion' }}"
                        class="h-full w-full object-cover"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                    >
                @endif
            </a>
        @endforeach
    </div>
@endif