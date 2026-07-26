{{-- resources/views/partials/frontend/home/hero/banner-carousel.blade.php --}}

@php
    $banners = $banners ?? collect();
    $key = $key ?? 'hero';
    $alt = $alt ?? 'Micronix promotion';

    $autoplay = $autoplay ?? true;
    $loop = $loop ?? true;
    $dots = $dots ?? true;
    $navigation = $navigation ?? false;
    $delay = $delay ?? 5000;
@endphp

@if ($banners->isNotEmpty())
    <x-frontend.carousel
        type="banner"
        :autoplay="$autoplay"
        :loop="$loop"
        :dots="$dots"
        :navigation="$navigation"
        :delay="$delay"
    >
        @foreach ($banners as $banner)
            <div
                class="h-full min-w-0 flex-[0_0_100%]"
                wire:key="{{ $key }}-{{ $banner->id }}"
            >
                <a
                    href="{{ $banner->url ?: '#' }}"
                    class="block h-full overflow-hidden rounded bg-zinc-100"
                >
                    @if ($banner->media)
                        <img
                            src="{{ \App\Support\MediaUrl::get($banner->media) }}"
                            alt="{{ $banner->title ?? $alt }}"
                            class="h-full w-full object-cover"
                        >
                    @endif
                </a>
            </div>
        @endforeach
    </x-frontend.carousel>
@endif