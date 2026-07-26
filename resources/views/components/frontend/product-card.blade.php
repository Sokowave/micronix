{{-- resources/views/partials/frontend/products/listing/product-card.blade.php --}}

<article
    class="
        group relative flex h-full min-w-0 flex-col
        overflow-hidden rounded-xl
        border border-zinc-200
        bg-white
        transition duration-200
        hover:border-micronix-200
        hover:shadow-lg hover:shadow-zinc-200/50
    "
>
    {{-- ========================================================= --}}
    {{-- Product Image                                             --}}
    {{-- ========================================================= --}}

    <div class="relative">

        <a
            href="#"
            wire:navigate
            class="
                relative flex aspect-square
                items-center justify-center
                overflow-hidden
                bg-zinc-50
                p-4
            "
        >
            <img
                src="https://placehold.co/600x600/ffffff/18181b?text=Product"
                alt="HP EliteBook 840 G8"
                loading="lazy"
                class="
                    h-full w-full
                    object-contain
                    transition-transform duration-300
                    group-hover:scale-[1.03]
                "
            >
        </a>

        {{-- Badges --}}
        <div
            class="
                pointer-events-none
                absolute left-2 top-2
                z-10
                flex flex-col items-start gap-1
            "
        >
            <span
                class="
                    rounded-md
                    bg-micronix-600
                    px-2 py-1
                    text-[9px] font-bold
                    uppercase tracking-wide
                    text-white
                "
            >
                -15%
            </span>

            <span
                class="
                    rounded-md
                    bg-emerald-500
                    px-2 py-1
                    text-[9px] font-bold
                    uppercase tracking-wide
                    text-white
                "
            >
                New
            </span>
        </div>

        {{-- Wishlist --}}
        <button
            type="button"
            aria-label="Add HP EliteBook 840 G8 to wishlist"
            class="
                absolute right-2 top-2
                z-10
                flex size-8
                cursor-pointer
                items-center justify-center
                rounded-full
                border border-zinc-200
                bg-white/95
                text-zinc-500
                shadow-sm
                transition
                hover:border-micronix-200
                hover:bg-micronix-50
                hover:text-micronix-600
            "
        >
            <flux:icon.heart class="size-4" />
        </button>
    </div>

    {{-- ========================================================= --}}
    {{-- Product Details                                           --}}
    {{-- ========================================================= --}}

    <div class="flex flex-1 flex-col p-3">

        {{-- Brand --}}
        <a
            href="#"
            wire:navigate
            class="
                mb-1
                text-[10px] font-semibold
                uppercase tracking-wide
                text-zinc-400
                transition
                hover:text-micronix-600
            "
        >
            HP
        </a>

        {{-- Product Name --}}
        <h3>
            <a
                href="#"
                wire:navigate
                class="
                    line-clamp-2
                    min-h-10
                    text-sm font-medium
                    leading-5 text-zinc-800
                    transition
                    group-hover:text-micronix-600
                "
            >
                HP EliteBook 840 G8 Intel Core i7 16GB RAM 512GB SSD
            </a>
        </h3>

        {{-- Rating --}}
        <div class="mt-2 flex items-center gap-1.5">

            <div
                class="flex items-center gap-0.5 text-amber-400"
                aria-label="4.8 out of 5 stars"
            >
                <flux:icon.star variant="solid" class="size-3" />
                <flux:icon.star variant="solid" class="size-3" />
                <flux:icon.star variant="solid" class="size-3" />
                <flux:icon.star variant="solid" class="size-3" />
                <flux:icon.star variant="solid" class="size-3" />
            </div>

            <span class="text-[10px] text-zinc-400">
                (24)
            </span>
        </div>

        {{-- Pricing --}}
        <div class="mt-3">

            <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">

                <span
                    class="
                        text-base font-bold
                        tracking-tight
                        text-zinc-950
                    "
                >
                    KES 74,999
                </span>

                <span
                    class="
                        text-[11px]
                        text-zinc-400
                        line-through
                    "
                >
                    KES 89,999
                </span>

            </div>

            <p class="mt-0.5 text-[10px] text-zinc-400">
                VAT inclusive
            </p>
        </div>

        {{-- Spacer --}}
        <div class="flex-1"></div>

        {{-- ===================================================== --}}
        {{-- Stock + Action                                        --}}
        {{-- ===================================================== --}}

        <div class="mt-3 border-t border-zinc-100 pt-3">

            <div class="mb-2.5 flex items-center justify-between gap-2">

                {{-- Stock --}}
                <div
                    class="
                        flex min-w-0 items-center gap-1.5
                        text-[10px] font-medium
                        text-emerald-600
                    "
                >
                    <span
                        class="
                            size-1.5 shrink-0
                            rounded-full
                            bg-emerald-500
                        "
                    ></span>

                    <span class="truncate">
                        In Stock
                    </span>
                </div>

                {{-- Delivery --}}
                <span
                    class="
                        hidden truncate
                        text-[10px]
                        text-zinc-400
                        sm:block
                    "
                >
                    Fast Delivery
                </span>
            </div>

            {{-- Add to Cart --}}
            <button
                type="button"
                class="
                    flex h-9 w-full
                    cursor-pointer
                    items-center justify-center
                    gap-2
                    rounded-lg
                    bg-micronix-600
                    px-3
                    text-xs font-semibold
                    text-white
                    transition
                    hover:bg-micronix-700
                    active:scale-[0.98]
                "
            >
                <flux:icon.shopping-cart class="size-4" />

                <span>
                    Add to Cart
                </span>
            </button>

        </div>
    </div>
</article>