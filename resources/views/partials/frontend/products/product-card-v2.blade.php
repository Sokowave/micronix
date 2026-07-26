@props([
    'product',
    'badge' => null,
])

@php
    $details = $product->details();
    $image = $details->primaryMedia();
@endphp

<article
    wire:key="product-card-v2-{{ $product->public_id }}"
    class="group w-[170px] shrink-0 sm:w-auto"
>
    <a
        href="{{ route('products.show', $product->slug) }}"
        wire:navigate
        class="block"
    >
        {{-- Product Image --}}
        <div
            class="
                relative flex aspect-square
                items-center justify-center
                overflow-hidden rounded-lg
                border border-zinc-200
                bg-white p-3
                transition
                group-hover:border-micronix-200
                group-hover:shadow-sm
            "
        >
            {{-- Badge --}}
            @if ($badge)
                <span
                    class="
                        absolute left-2 top-2 z-10
                        rounded bg-micronix-600
                        px-1.5 py-0.5
                        text-[8px] font-bold uppercase
                        text-white
                    "
                >
                    {{ $badge }}
                </span>
            @elseif ($details->hasDiscount())
                <span
                    class="
                        absolute left-2 top-2 z-10
                        rounded bg-micronix-600
                        px-1.5 py-0.5
                        text-[8px] font-bold
                        text-white
                    "
                >
                    -{{ $details->discountPercentage() }}%
                </span>
            @endif

            {{-- Image --}}
            <img
                src="{{ $image?->url ?? 'https://placehold.co/400x400' }}"
                alt="{{ $product->name }}"
                class="
                    h-full w-full object-contain
                    transition-transform duration-300
                    group-hover:scale-105
                "
                loading="lazy"
                width="400"
                height="400"
            >
        </div>

        {{-- Product Details --}}
        <div class="pt-2">
            <h3
                class="
                    line-clamp-1
                    text-[11px] font-medium
                    text-zinc-600
                    transition
                    group-hover:text-micronix-600
                "
                title="{{ $product->name }}"
            >
                {{ $product->name }}
            </h3>

            {{-- Price --}}
            <div class="mt-1 flex flex-wrap items-center gap-x-1">
                <span class="text-xs font-bold text-zinc-900">
                    KES {{ number_format($details->currentPrice()) }}
                </span>

                @if ($details->hasDiscount())
                    <span class="text-[10px] text-zinc-400 line-through">
                        KES {{ number_format((float) $product->price) }}
                    </span>
                @endif
            </div>
        </div>
    </a>
</article>