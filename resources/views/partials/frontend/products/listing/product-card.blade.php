{{-- resources/views/partials/frontend/products/listing/product-card.blade.php --}}

@php
    $details = $product->details();
    $image = $details->primaryMedia();
@endphp

<article
    class="
        group flex min-w-0 flex-col
        rounded-lg border border-zinc-200
        bg-white p-2
        transition
        hover:border-zinc-300
        hover:shadow-sm
    "
>
    {{-- Image --}}
    <div class="relative aspect-square rounded overflow-hidden">

        {{-- Badge --}}
        @if ($details->hasDiscount())
            <span
                class="
                    absolute left-0 top-0 z-10
                    rounded bg-red-500
                    px-1.5 py-0.5
                    text-[10px] font-bold text-white
                "
            >
                -{{ $details->discountPercentage() }}%
            </span>
        @elseif ($product->condition === 'new')
            <span
                class="
                    absolute left-0 top-0 z-10
                    rounded bg-green-500
                    px-1.5 py-0.5
                    text-[10px] font-bold uppercase text-white
                "
            >
                New
            </span>
        @endif

        {{-- Wishlist --}}
        <button
            type="button"
            aria-label="Add {{ $product->name }} to wishlist"
            class="
                absolute right-0 top-0 z-10
                flex size-7 cursor-pointer
                items-center justify-center
                rounded-full
                text-zinc-600
                transition
                hover:bg-zinc-100
                hover:text-micronix-600
            "
        >
            <flux:icon.heart class="size-4" />
        </button>

        {{-- Product Image --}}
        <a
            href="{{ route('products.show', $product->slug) }}"
            wire:navigate
            class="
                flex h-full w-full
                items-center justify-center
                overflow-hidden
            "
        >
            @if ($image)
                <img
                    src="{{ $image->url }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    class="
                        h-full w-full
                        object-contain
                        transition-transform duration-300
                        group-hover:scale-[1.02]
                    "
                >
            @else
                <div
                    class="
                        flex h-full w-full
                        items-center justify-center
                        bg-zinc-50 text-zinc-300
                    "
                >
                    <flux:icon.photo class="size-9" />
                </div>
            @endif
        </a>
    </div>

    {{-- Product Info --}}
    <div class="flex flex-1 flex-col pt-2">

        {{-- Brand --}}
        @if ($product->brand)
            <a
                href="{{ route('brands.show', $product->brand->slug) }}"
                wire:navigate
                class="
                    mb-0.5 truncate
                    text-[10px] font-medium
                    text-zinc-500
                    transition
                    hover:text-micronix-600
                "
            >
                {{ $product->brand->name }}
            </a>
        @endif

        {{-- Name --}}
        <h3>
            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                title="{{ $product->name }}"
                class="
                    line-clamp-2
                    min-h-9
                    text-xs font-semibold
                    leading-[18px]
                    text-zinc-800
                    transition
                    hover:text-micronix-600
                "
            >
                {{ $product->name }}
            </a>
        </h3>

        {{-- Rating --}}
        <div class="mt-1 flex items-center gap-1">
            <div class="flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <flux:icon.star
                        class="size-3 fill-amber-400 text-amber-400"
                    />
                @endfor
            </div>

            <span class="text-[10px] text-zinc-400">
                (0)
            </span>
        </div>

        {{-- Price --}}
        <div class="mt-1.5 flex flex-wrap items-baseline gap-x-1.5">
            <span class="text-sm font-bold text-micronix-600">
                KES {{ number_format($details->currentPrice()) }}
            </span>

            @if ($details->hasDiscount())
                <span class="text-[10px] text-zinc-400 line-through">
                    KES {{ number_format((float) $product->price) }}
                </span>
            @endif
        </div>

        {{-- Stock --}}
        <div class="mt-1.5">
            @if ($details->inStock())
                <span
                    class="
                        inline-flex items-center gap-1
                        text-[10px] text-zinc-500
                    "
                >
                    <span class="size-1.5 rounded-full bg-green-500"></span>

                    {{ $details->stockLabel() }}
                </span>
            @else
                <span
                    class="
                        inline-flex items-center gap-1
                        text-[10px] text-zinc-500
                    "
                >
                    <span class="size-1.5 rounded-full bg-red-500"></span>

                    {{ $details->stockLabel() }}
                </span>
            @endif
        </div>

        {{-- Add to Cart --}}
        <button
            type="button"
            @disabled($details->outOfStock())
            class="
                mt-2 flex h-8 w-full
                cursor-pointer
                items-center justify-center
                gap-1.5 rounded-md
                border border-micronix-500
                bg-white
                text-[11px] font-semibold
                text-micronix-600
                transition
                hover:bg-micronix-50

                disabled:cursor-not-allowed
                disabled:border-zinc-200
                disabled:bg-zinc-50
                disabled:text-zinc-400
            "
        >
            <flux:icon.shopping-cart class="size-3.5" />

            {{ $details->inStock() ? 'Add to Cart' : 'Out of Stock' }}
        </button>
    </div>
</article>