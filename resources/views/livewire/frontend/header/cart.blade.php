{{-- resources/views/livewire/frontend/header/cart.blade.php --}}

<div class="group relative">

    <a
        href="#"
        wire:navigate
        class="flex h-12 cursor-pointer items-center gap-2 rounded-xl px-3 transition hover:bg-zinc-50"
    >
        <div class="relative">

            <flux:icon.shopping-cart
                class="size-5 text-zinc-700 transition group-hover:text-micronix-600"
            />

            <span
                class="
                    absolute -right-2.5 -top-2.5
                    flex h-4.5 min-w-4.5 items-center justify-center
                    rounded-full bg-micronix-500 px-1
                    text-[10px] font-semibold text-white
                "
            >
                0
            </span>

        </div>

        <div class="hidden xl:block">
            <span class="block text-[11px] leading-none text-zinc-400">
                Your cart
            </span>

            <span class="mt-1 block text-sm font-medium leading-none text-zinc-800">
                KSh 0
            </span>
        </div>

        <flux:icon.chevron-down
            class="hidden size-4 text-zinc-400 transition group-hover:rotate-180 xl:block"
        />

    </a>

    {{-- Mini Cart --}}
    <div
        class="
            invisible absolute right-0 top-full z-50 mt-2
            w-96 overflow-hidden rounded-2xl
            border border-zinc-200 bg-white
            opacity-0 shadow-xl
            transition-all duration-200
            group-hover:visible
            group-hover:opacity-100
        "
    >

        {{-- Header --}}
        <div class="border-b border-zinc-100 px-5 py-4">

            <div class="flex items-center justify-between">

                <h3 class="font-semibold text-zinc-900">
                    Shopping Cart
                </h3>

                <span class="rounded-full bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-600">
                    0 Items
                </span>

            </div>

        </div>

        {{-- Empty State --}}
        <div class="flex flex-col items-center px-8 py-10">

            <div class="mb-5 rounded-full bg-zinc-100 p-5">

                <flux:icon.shopping-cart
                    class="size-8 text-zinc-400"
                />

            </div>

            <h4 class="text-base font-semibold text-zinc-900">
                Your cart is empty
            </h4>

            <p class="mt-2 max-w-xs text-center text-sm leading-6 text-zinc-500">
                Looks like you haven't added any products yet.
            </p>

            <a
                href="{{ route('products.index')}}"
                wire:navigate
                class="
                    mt-6 inline-flex items-center gap-2
                    rounded-xl bg-micronix-600
                    px-5 py-3 text-sm font-medium
                    text-white transition
                    hover:bg-micronix-700
                "
            >
                Continue Shopping

                <flux:icon.arrow-right class="size-4" />

            </a>

        </div>

        {{-- Future Cart Items --}}
        {{--
        <div class="max-h-96 overflow-y-auto">
            Cart items...
        </div>

        <div class="border-t border-zinc-100 p-5">

            <div class="mb-4 flex items-center justify-between">
                <span>Subtotal</span>
                <span>KSh 52,999</span>
            </div>

            <a href="#" class="...">
                View Cart
            </a>

            <a href="#" class="...">
                Checkout
            </a>

        </div>
        --}}

    </div>

</div>