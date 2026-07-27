{{-- resources/views/partials/frontend/products/product-card-v3.blade.php --}}

@php
    $details = $product->details();
    $primaryMedia = $details->primaryMedia();
@endphp

<article class="group min-w-0">
    <a
        href="{{ route('products.show', $product->slug) }}"
        wire:navigate
        class="block"
    >
        <div
            class="
                relative flex aspect-square
                items-center justify-center
                overflow-hidden rounded-lg
                border border-zinc-200
                bg-white p-1
                transition
                group-hover:border-micronix-200
                group-hover:shadow-sm
            "
        >
            @if ($primaryMedia?->url)
                <img
                    src="{{ $primaryMedia->url }}"
                    alt="{{ $product->name }}"
                    loading="lazy"
                    class="
                        h-full w-full object-contain
                        transition-transform duration-300
                        group-hover:scale-105 rounded-lg
                    "
                >
            @endif
        </div>

        <div class="pt-2">
            <h3
                class="
                    line-clamp-1
                    text-[11px] font-medium
                    text-zinc-600
                    transition
                    group-hover:text-micronix-600
                "
            >
                {{ $product->name }}
            </h3>

            <p class="mt-1 text-xs font-bold text-zinc-900">
                KES {{ number_format($details->currentPrice()) }}
            </p>
        </div>
    </a>
</article>