@props([
    'product',
    'badge' => null,
])

@php
    $details = $product->details();
    $image = $details->primaryMedia();
@endphp

<article
    wire:key="product-card-{{ $product->public_id }}"
    class="group min-w-0"
>
    {{-- Product Image --}}
    <div
        class="
            relative aspect-square
            overflow-hidden rounded-xl
            bg-zinc-50
        "
    >
        <a
            href="{{ route('products.show', $product->slug) }}"
            wire:navigate
            class="block h-full w-full"
        >
            <img
                src="{{ $image?->url ?? 'https://placehold.co/600x600' }}"
                alt="{{ $product->name }}"
                class="
                    h-full w-full object-contain p-1 rounded-xl
                    transition-transform duration-300
                    group-hover:scale-105
                "
                loading="lazy"
                width="600"
                height="600"
            >
        </a>

        {{-- Badge --}}
        @if ($badge)
            <span
                class="
                    absolute left-2 top-2
                    rounded-md bg-micronix-600
                    px-2 py-1
                    text-[11px] font-semibold text-white
                "
            >
                {{ $badge }}
            </span>
        @elseif ($details->hasDiscount())
            <span
                class="
                    absolute left-2 top-2
                    rounded-md bg-micronix-600
                    px-2 py-1
                    text-[11px] font-semibold text-white
                "
            >
                -{{ $details->discountPercentage() }}%
            </span>
        @endif

        {{-- Wishlist --}}
        <button
            type="button"
            aria-label="Add {{ $product->name }} to wishlist"
            class="
                absolute right-2 top-2
                flex size-8 items-center justify-center
                rounded-full border border-zinc-200
                bg-white text-zinc-500
                shadow-sm
                transition
                hover:border-micronix-200
                hover:text-micronix-600
            "
        >
            <flux:icon.heart class="size-4" />
        </button>
    </div>

    {{-- Product Details --}}
    <div class="pt-3">

        {{-- Brand --}}
        @if ($product->brand)
            <p
                class="
                    mb-1 truncate
                    text-xs font-medium uppercase
                    tracking-wide text-zinc-400
                "
            >
                {{ $product->brand->name }}
            </p>
        @endif

        {{-- Product Name --}}
        <h3>
            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                class="
                    line-clamp-2
                    min-h-10
                    text-sm font-medium leading-5
                    text-zinc-800
                    transition
                    hover:text-micronix-600
                "
                title="{{ $product->name }}"
            >
                {{ $product->name }}
            </a>
        </h3>

        {{-- Price --}}
        <div class="mt-2">
            <span class="text-base font-bold text-zinc-900">
                KES {{ number_format($details->currentPrice()) }}
            </span>

            @if ($details->hasDiscount())
                <span class="ml-1 text-xs text-zinc-400 line-through">
                    KES {{ number_format((float) $product->price) }}
                </span>
            @endif
        </div>
    </div>
</article>