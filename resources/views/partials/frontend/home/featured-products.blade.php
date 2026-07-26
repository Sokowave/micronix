{{-- resources/views/partials/frontend/home/featured-products.blade.php --}}

@if ($featuredProducts->isNotEmpty())
    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            {{-- Header --}}
            <div class="mb-4 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-zinc-900">
                        Featured Products
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Handpicked tech you'll love
                    </p>
                </div>

                <a
                    href="#"
                    wire:navigate
                    class="
                        group inline-flex shrink-0 items-center gap-1
                        text-sm font-medium text-micronix-600
                        transition hover:text-micronix-700
                    "
                >
                    View All

                    <flux:icon.arrow-right
                        class="
                            size-4
                            transition-transform duration-200
                            group-hover:translate-x-0.5
                        "
                    />
                </a>
            </div>

            {{-- Products --}}
            <x-frontend.carousel
                type="products"
                :autoplay="false"
                :loop="false"
                :dots="false"
                :navigation="true"
            >
                @foreach ($featuredProducts as $product)
                    <div
                        wire:key="featured-product-{{ $product->public_id }}"
                        class="
                            min-w-0
                            flex-[0_0_70%]
                            pr-3
                            sm:flex-[0_0_50%]
                            md:flex-[0_0_33.333%]
                            lg:flex-[0_0_25%]
                            xl:flex-[0_0_16.6667%]
                        "
                    >
                        @include(
                            'partials.frontend.products.product-card-v1',
                            [
                                'product' => $product,
                                'badge' => 'Featured',
                            ]
                        )
                    </div>
                @endforeach
            </x-frontend.carousel>

        </div>
    </section>
@endif