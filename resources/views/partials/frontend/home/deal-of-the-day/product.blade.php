{{-- resources/views/partials/frontend/home/deal-of-the-day/product.blade.php --}}

@php
    $details = $product->details();
    $primaryMedia = $details->primaryMedia();
@endphp

<article class="group flex h-full min-w-0 flex-col bg-white p-3">

    {{-- Image --}}
    <div class="relative flex h-[125px] items-center justify-center">
        <a
            href="{{ route('products.show', $product->slug) }}"
            wire:navigate
            class="flex h-full w-full items-center justify-center"
        >
            @if ($primaryMedia?->url)
                <img
                    src="{{ $primaryMedia->url }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    class="
                        max-h-full max-w-full
                        object-contain
                        transition-transform duration-300
                        group-hover:scale-105
                    "
                >
            @else
                <img
                    src="https://placehold.co/400x400"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    class="
                        max-h-full max-w-full
                        object-contain
                        transition-transform duration-300
                        group-hover:scale-105
                    "
                >
            @endif
        </a>

        {{-- Discount --}}
        @if ($details->hasDiscount())
            <span
                class="
                    absolute left-0 top-0
                    rounded bg-red-500
                    px-1.5 py-0.5
                    text-[9px] font-bold text-white
                "
            >
                -{{ $details->discountPercentage() }}%
            </span>
        @endif
    </div>

    {{-- Details --}}
    <div class="mt-2">
        <h3>
            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                class="
                    line-clamp-1
                    text-xs font-medium text-zinc-800
                    transition
                    hover:text-micronix-600
                "
            >
                {{ $product->name }}
            </a>
        </h3>

        {{-- Price --}}
        <div class="mt-1 flex flex-wrap items-center gap-1.5">
            <span class="text-xs font-bold text-zinc-900">
                KES {{ number_format($details->currentPrice()) }}
            </span>

            @if ($details->hasDiscount())
                <span class="text-[9px] text-zinc-400 line-through">
                    KES {{ number_format((float) $product->price) }}
                </span>
            @endif
        </div>

        {{-- Add to Cart --}}
        <button
            type="button"
            class="
                mt-2 inline-flex cursor-pointer
                items-center gap-1.5
                rounded bg-micronix-600
                px-3 py-1.5
                text-[10px] font-semibold text-white
                transition
                hover:bg-micronix-700
            "
        >
            <flux:icon.shopping-cart class="size-3.5" />

            Add to Cart
        </button>
    </div>

</article>