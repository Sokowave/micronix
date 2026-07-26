{{-- resources/views/partials/frontend/products/show/actions.blade.php --}}

<div class="min-w-0 space-y-3">

    {{-- Quantity + Add to Cart --}}
    <div class="flex min-w-0 gap-2">

        {{-- Quantity --}}
        <div
            class="
                flex h-11 shrink-0 items-center
                overflow-hidden rounded-lg
                border border-zinc-200 bg-white
            "
        >
            <button
                type="button"
                aria-label="Decrease quantity"
                class="
                    flex h-full w-9 cursor-pointer
                    items-center justify-center
                    text-zinc-500 transition
                    hover:bg-zinc-50 hover:text-micronix-600
                    disabled:cursor-not-allowed disabled:opacity-40
                "
            >
                <flux:icon.minus class="size-4" />
            </button>

            <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                max="10"
                inputmode="numeric"
                aria-label="Product quantity"
                class="
                    h-full w-9
                    border-0 border-x border-zinc-200
                    bg-white p-0
                    text-center text-sm font-semibold
                    text-zinc-900 outline-none
                    [appearance:textfield]
                    focus:ring-0
                    [&::-webkit-inner-spin-button]:appearance-none
                    [&::-webkit-outer-spin-button]:appearance-none
                "
            >

            <button
                type="button"
                aria-label="Increase quantity"
                class="
                    flex h-full w-9 cursor-pointer
                    items-center justify-center
                    text-zinc-500 transition
                    hover:bg-zinc-50 hover:text-micronix-600
                    disabled:cursor-not-allowed disabled:opacity-40
                "
            >
                <flux:icon.plus class="size-4" />
            </button>
        </div>

        {{-- Add to Cart --}}
        <button
            type="button"
            class="
                inline-flex h-11 min-w-0 flex-1
                cursor-pointer items-center justify-center
                gap-2 rounded-lg
                bg-micronix-600 px-3
                text-sm font-semibold text-white
                transition
                hover:bg-micronix-700
                active:scale-[0.99]
                disabled:cursor-not-allowed disabled:opacity-50
            "
        >
            <flux:icon.shopping-cart class="size-4 shrink-0" />

            <span class="truncate">
                Add to Cart
            </span>
        </button>

    </div>

    {{-- Buy Now + WhatsApp --}}
    <div class="flex min-w-0 gap-2">

        <button
            type="button"
            class="
                inline-flex h-11 min-w-0 flex-1
                cursor-pointer items-center justify-center
                gap-2 rounded-lg
                border border-micronix-600
                bg-micronix-50 px-3
                text-sm font-semibold text-micronix-700
                transition
                hover:bg-micronix-100
                active:scale-[0.99]
                disabled:cursor-not-allowed disabled:opacity-50
            "
        >
            <flux:icon.bolt class="size-4 shrink-0" />

            <span class="truncate">
                Buy Now
            </span>
        </button>

        <a
            href="#"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Order via WhatsApp"
            class="
                inline-flex size-11 shrink-0
                items-center justify-center
                rounded-lg
                bg-[#25D366]
                text-white
                transition
                hover:bg-[#20bd5a]
                active:scale-[0.98]
            "
        >
            <svg
                viewBox="0 0 24 24"
                aria-hidden="true"
                class="size-5 fill-current"
            >
                <path d="M12.04 2a9.84 9.84 0 0 0-8.42 14.93L2 22l5.2-1.58A9.96 9.96 0 1 0 12.04 2Zm0 17.93a8.04 8.04 0 0 1-4.1-1.12l-.3-.18-3.08.94.96-3-.2-.31a7.93 7.93 0 1 1 6.72 3.67Zm4.4-5.94c-.24-.12-1.43-.7-1.65-.79-.22-.08-.38-.12-.54.12-.16.24-.62.79-.76.95-.14.16-.28.18-.52.06-.24-.12-1.02-.37-1.94-1.2a7.23 7.23 0 0 1-1.34-1.66c-.14-.24-.02-.37.1-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.4-.54-.41h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.7 2.59 4.11 3.63.57.25 1.02.4 1.37.51.58.18 1.1.16 1.51.1.46-.07 1.43-.59 1.63-1.15.2-.57.2-1.06.14-1.16-.06-.1-.22-.16-.46-.28Z"/>
            </svg>
        </a>

    </div>

    @include('partials.frontend.products.show.secondary-actions')

</div>