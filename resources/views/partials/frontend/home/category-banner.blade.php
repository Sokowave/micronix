{{-- resources/views/partials/frontend/home/category-banner.blade.php --}}

@php
    $media = $banner?->media;
@endphp

<div class="overflow-hidden rounded-xl">
    @if ($media?->url)
        @if ($banner->link)
            <a
                href="{{ $banner->link }}"
                class="block"
            >
                <img
                    src="{{ $media->url }}"
                    alt="{{ $banner->title ?? 'Micronix promotion' }}"
                    loading="lazy"
                    class="aspect-[16/3] w-full object-cover"
                >
            </a>
        @else
            <img
                src="{{ $media->url }}"
                alt="{{ $banner->title ?? 'Micronix promotion' }}"
                loading="lazy"
                class="aspect-[16/3] w-full object-cover"
            >
        @endif
    @else
        <img
            src="https://placehold.co/1600x300?text=Micronix+Promotion"
            alt="Micronix promotion"
            loading="lazy"
            class="aspect-[16/3] w-full object-cover"
        >
    @endif
</div>