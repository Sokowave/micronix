{{-- resources/views/partials/frontend/home/deal-of-the-day/product.blade.php --}}

<article class="group flex h-full min-w-0 flex-col bg-white p-3">

    {{-- Image --}}
    <div class="relative flex h-[125px] items-center justify-center">
        <a
            href="#"
            wire:navigate
            class="flex h-full w-full items-center justify-center"
        >
            <img
                src="{{ $image }}"
                alt="{{ $name }}"
                class="
                    max-h-full max-w-full
                    object-contain
                    transition-transform duration-300
                    group-hover:scale-105
                "
            >
        </a>

        <span
            class="
                absolute left-0 top-0
                rounded bg-red-500
                px-1.5 py-0.5
                text-[9px] font-bold text-white
            "
        >
            -{{ $discount }}
        </span>
    </div>

    {{-- Details --}}
    <div class="mt-2">
        <h3>
            <a
                href="#"
                wire:navigate
                class="
                    line-clamp-1
                    text-xs font-medium text-zinc-800
                    transition
                    hover:text-micronix-600
                "
            >
                {{ $name }}
            </a>
        </h3>

        {{-- Price --}}
        <div class="mt-1 flex flex-wrap items-center gap-1.5">
            <span class="text-xs font-bold text-zinc-900">
                KES {{ $price }}
            </span>

            <span class="text-[9px] text-zinc-400 line-through">
                KES {{ $oldPrice }}
            </span>
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