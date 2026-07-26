{{-- resources/views/partials/frontend/home/why-micronix.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <div
            class="
                relative overflow-hidden rounded-xl
                border border-micronix-100
                bg-gradient-to-r
                from-micronix-50 via-white to-micronix-50
            "
        >
            {{-- Decorative background --}}
            <div
                class="
                    pointer-events-none absolute
                    -right-16 -top-20
                    size-64 rounded-full
                    bg-micronix-100/60 blur-3xl
                "
            ></div>

            <div class="relative px-5 py-5 sm:px-6">

                {{-- Heading --}}
                <h2 class="text-lg font-bold text-zinc-900">
                    Why Shop With Micronix?
                </h2>

                <div class="mt-4 flex items-stretch">

                    {{-- ================================================= --}}
                    {{-- Benefits                                          --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            grid min-w-0 flex-1
                            grid-cols-1 gap-y-5
                            sm:grid-cols-2
                            lg:grid-cols-5
                        "
                    >
                        {{-- Wide Range --}}
                        <div class="flex gap-3 lg:pr-4">
                            <div
                                class="
                                    flex size-9 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    border border-micronix-200
                                    bg-white
                                    text-micronix-600
                                "
                            >
                                <flux:icon.squares-2x2 class="size-4.5" />
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-semibold text-zinc-900">
                                    Wide Range of Products
                                </h3>

                                <p class="mt-1 text-[10px] leading-4 text-zinc-500">
                                    From the latest tech to everyday essentials,
                                    all in one place.
                                </p>
                            </div>
                        </div>

                        {{-- Best Prices --}}
                        <div class="flex gap-3 lg:px-4">
                            <div
                                class="
                                    flex size-9 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    border border-micronix-200
                                    bg-white
                                    text-micronix-600
                                "
                            >
                                <flux:icon.tag class="size-4.5" />
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-semibold text-zinc-900">
                                    Best Prices
                                </h3>

                                <p class="mt-1 text-[10px] leading-4 text-zinc-500">
                                    Competitive prices with regular deals
                                    and exclusive offers.
                                </p>
                            </div>
                        </div>

                        {{-- Trusted --}}
                        <div class="flex gap-3 lg:px-4">
                            <div
                                class="
                                    flex size-9 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    border border-micronix-200
                                    bg-white
                                    text-micronix-600
                                "
                            >
                                <flux:icon.shield-check class="size-4.5" />
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-semibold text-zinc-900">
                                    Trusted by Thousands
                                </h3>

                                <p class="mt-1 text-[10px] leading-4 text-zinc-500">
                                    Join customers across Kenya who trust
                                    Micronix for their tech.
                                </p>
                            </div>
                        </div>

                        {{-- Delivery --}}
                        <div class="flex gap-3 lg:px-4">
                            <div
                                class="
                                    flex size-9 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    border border-micronix-200
                                    bg-white
                                    text-micronix-600
                                "
                            >
                                <flux:icon.truck class="size-4.5" />
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-semibold text-zinc-900">
                                    Fast & Reliable Delivery
                                </h3>

                                <p class="mt-1 text-[10px] leading-4 text-zinc-500">
                                    Quick delivery to your doorstep,
                                    anywhere in Kenya.
                                </p>
                            </div>
                        </div>

                        {{-- Support --}}
                        <div class="flex gap-3 lg:px-4">
                            <div
                                class="
                                    flex size-9 shrink-0
                                    items-center justify-center
                                    rounded-lg
                                    border border-micronix-200
                                    bg-white
                                    text-micronix-600
                                "
                            >
                                <flux:icon.chat-bubble-left-right class="size-4.5" />
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-semibold text-zinc-900">
                                    After Sales Support
                                </h3>

                                <p class="mt-1 text-[10px] leading-4 text-zinc-500">
                                    We're here even after you buy,
                                    for any assistance.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ================================================= --}}
                    {{-- Support Person                                    --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            relative hidden
                            w-[150px] shrink-0
                            lg:block
                        "
                    >
                        <img
                            src="https://placehold.co/300x260/transparent/4f39f6?text=Support"
                            alt="Micronix customer support"
                            class="
                                absolute
                                -bottom-5 right-0
                                max-h-[145px] w-auto
                                object-contain object-bottom
                            "
                        >
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>