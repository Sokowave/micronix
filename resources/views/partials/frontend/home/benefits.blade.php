{{-- resources/views/partials/frontend/home/benefits.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <div
            class="
                -mx-4 flex overflow-x-auto
                border-y border-zinc-200
                bg-white px-4
                [scrollbar-width:none]
                [&::-webkit-scrollbar]:hidden
                sm:mx-0 sm:rounded-xl sm:border
                sm:px-0
            "
        >
            {{-- Free Shipping --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 border-r border-zinc-200 px-4 py-5">
                <flux:icon.truck class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Free Shipping
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        Orders over KES 5,000
                    </p>
                </div>
            </div>

            {{-- Secure Payments --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 border-r border-zinc-200 px-4 py-5">
                <flux:icon.lock-closed class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Secure Payments
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        Safe & protected
                    </p>
                </div>
            </div>

            {{-- Easy Returns --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 border-r border-zinc-200 px-4 py-5">
                <flux:icon.arrow-path class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Easy Returns
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        Hassle-free returns
                    </p>
                </div>
            </div>

            {{-- Warranty --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 border-r border-zinc-200 px-4 py-5">
                <flux:icon.shield-check class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Warranty
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        Genuine warranty
                    </p>
                </div>
            </div>

            {{-- Customer Support --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 border-r border-zinc-200 px-4 py-5">
                <flux:icon.chat-bubble-left-right class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Customer Support
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        We're here to help
                    </p>
                </div>
            </div>

            {{-- Quality --}}
            <div class="flex w-[210px] shrink-0 items-center gap-3 px-4 py-5">
                <flux:icon.check-badge class="size-7 shrink-0 text-micronix-600" />

                <div class="min-w-0">
                    <h3 class="whitespace-nowrap text-sm font-semibold text-zinc-900">
                        Quality Guaranteed
                    </h3>

                    <p class="mt-0.5 whitespace-nowrap text-xs text-zinc-500">
                        Products you can trust
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>