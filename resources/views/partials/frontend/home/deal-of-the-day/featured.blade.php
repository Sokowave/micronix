{{-- resources/views/partials/frontend/home/deal-of-the-day/featured.blade.php --}}

<article
    class="
        group flex h-[180px]
        items-center gap-4
        bg-white p-3
    "
>
    {{-- Image --}}
    <a
        href="#"
        wire:navigate
        class="
            flex h-full w-[42%]
            shrink-0 items-center justify-center
        "
    >
        <img
            src="https://placehold.co/500x400"
            alt="Dell Inspiron 15 Laptop"
            class="
                max-h-full max-w-full
                object-contain
                transition-transform duration-300
                group-hover:scale-105
            "
        >
    </a>

    {{-- Details --}}
    <div class="min-w-0 flex-1">

        {{-- Name --}}
        <h3>
            <a
                href="#"
                wire:navigate
                class="
                    line-clamp-1
                    text-sm font-semibold
                    text-zinc-900
                    transition
                    hover:text-micronix-600
                "
            >
                Dell Inspiron 15 Laptop
            </a>
        </h3>

        {{-- Specifications --}}
        <p
            class="
                mt-1 line-clamp-1
                text-[10px] text-zinc-500
            "
        >
            Core i5 12th Gen · 8GB RAM · 512GB SSD · 15.6" FHD
        </p>

        {{-- Price --}}
        <div class="mt-2 flex flex-wrap items-center gap-2">
            <span class="text-sm font-bold text-zinc-900">
                KES 85,000
            </span>

            <span class="text-[10px] text-zinc-400 line-through">
                KES 100,000
            </span>

            <span
                class="
                    rounded bg-micronix-100
                    px-1.5 py-0.5
                    text-[9px] font-bold
                    text-micronix-600
                "
            >
                15% OFF
            </span>
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