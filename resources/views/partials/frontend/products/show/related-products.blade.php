{{-- resources/views/partials/frontend/products/show/related-products.blade.php --}}

@if (isset($relatedProducts) && $relatedProducts->isNotEmpty())
    <section class="py-8">
        <div class="mx-auto max-w-7xl px-2 xl:px-6">

            {{-- Header --}}
            <div class="mb-5 flex items-end justify-between gap-4">
                <div class="min-w-0">
                    <h2
                        class="
                            text-xl font-bold
                            tracking-tight
                            text-zinc-950
                        "
                    >
                        Related Products
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        You may also like these products.
                    </p>
                </div>

                @if ($product->category)
                    <a
                        href="{{ route('categories.show', $product->category) }}"
                        wire:navigate
                        class="
                            group inline-flex shrink-0
                            items-center gap-1
                            text-xs font-semibold
                            text-micronix-600
                            transition
                            hover:text-micronix-700
                        "
                    >
                        View All

                        <flux:icon.chevron-right
                            class="
                                size-3.5
                                transition-transform
                                group-hover:translate-x-0.5
                            "
                        />
                    </a>
                @endif
            </div>

            {{-- Products --}}
            <x-frontend.carousel
                type="products"
                :autoplay="false"
                :loop="false"
                :dots="false"
                :navigation="true"
            >
                @foreach ($relatedProducts as $relatedProduct)
                    <div
                        wire:key="related-product-{{ $relatedProduct->public_id }}"
                        class="
                            min-w-0
                            flex-[0_0_72%]
                            pr-2

                            xs:flex-[0_0_48%]

                            sm:flex-[0_0_33.333%]
                            sm:pr-3

                            lg:flex-[0_0_25%]

                            xl:flex-[0_0_20%]
                        "
                    >
                        @include(
                            'partials.frontend.products.listing.product-card',
                            [
                                'product' => $relatedProduct,
                            ]
                        )
                    </div>
                @endforeach
            </x-frontend.carousel>

        </div>
    </section>
@endif