{{-- resources/views/partials/frontend/home/deal-of-the-day/featured.blade.php --}}

@php
    $details = $product->details();
@endphp

<article
    class="
        group flex h-[180px]
        items-center gap-4
        bg-white p-3
    "
>
    {{-- Images --}}
    <div
        class="
            h-full w-[42%]
            min-w-0 shrink-0
        "
    >
        @if ($product->media->isNotEmpty())
            <x-frontend.carousel
                type="default"
                :autoplay="true"
                :loop="$product->media->count() > 1"
                :dots="$product->media->count() > 1"
                :navigation="false"
                :delay="4000"
                class="h-full"
            >
                @foreach ($product->media as $media)
                    <div
                        wire:key="deal-featured-{{ $product->public_id }}-media-{{ $media->id }}"
                        class="
                            flex h-full min-w-0
                            flex-[0_0_100%]
                            items-center justify-center
                        "
                    >
                        <a
                            href="{{ route('products.show', $product->slug) }}"
                            wire:navigate
                            class="
                                flex h-full w-full
                                items-center justify-center
                            "
                        >
                            <img
                                src="{{ $media->url }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                                class="
                                    max-h-full max-w-full
                                    object-contain
                                    transition-transform duration-300
                                    group-hover:scale-105
                                "
                            >
                        </a>
                    </div>
                @endforeach
            </x-frontend.carousel>
        @else
            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                class="
                    flex h-full w-full
                    items-center justify-center
                "
            >
                <img
                    src="https://placehold.co/500x400"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    class="
                        max-h-full max-w-full
                        object-contain
                        transition-transform duration-300
                        group-hover:scale-105
                    "
                >
            </a>
        @endif
    </div>

    {{-- Details --}}
    <div class="min-w-0 flex-1">

        {{-- Name --}}
        <h3>
            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                class="
                    line-clamp-1
                    text-sm font-semibold
                    text-zinc-900
                    transition
                    hover:text-micronix-600
                "
            >
                {{ $product->name }}
            </a>
        </h3>

        {{-- Specifications --}}
        @if ($product->short_description)
            <p
                class="
                    mt-1 line-clamp-1
                    text-[10px] text-zinc-500
                "
            >
                {{ $product->short_description }}
            </p>
        @endif

        {{-- Price --}}
        <div class="mt-2 flex flex-wrap items-center gap-2">
            <span class="text-sm font-bold text-zinc-900">
                KES {{ number_format($details->currentPrice()) }}
            </span>

            @if ($details->hasDiscount())
                <span class="text-[10px] text-zinc-400 line-through">
                    KES {{ number_format((float) $product->price) }}
                </span>

                <span
                    class="
                        rounded bg-micronix-100
                        px-1.5 py-0.5
                        text-[9px] font-bold
                        text-micronix-600
                    "
                >
                    {{ $details->discountPercentage() }}% OFF
                </span>
            @endif
        </div>

        {{-- Rating --}}
        <div class="mt-2 flex items-center gap-0.5">
            @for ($i = 0; $i < 5; $i++)
                <flux:icon.star
                    class="
                        size-3
                        fill-amber-400
                        text-amber-400
                    "
                />
            @endfor

            <span class="ml-1 text-[10px] text-zinc-400">
                (24)
            </span>
        </div>

        {{-- Add to Cart --}}
        <button
            type="button"
            class="
                mt-2 inline-flex
                cursor-pointer items-center gap-1.5
                rounded bg-micronix-600
                px-4 py-1.5
                text-[10px] font-semibold
                text-white
                transition
                hover:bg-micronix-700
            "
        >
            <flux:icon.shopping-cart class="size-3.5" />

            Add to Cart
        </button>
    </div>
</article>