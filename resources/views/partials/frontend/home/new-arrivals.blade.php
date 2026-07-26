{{-- resources/views/partials/frontend/home/new-arrivals.blade.php --}}

@if ($latestProducts->isNotEmpty())
    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            {{-- Header --}}
            <div class="mb-3 flex items-center justify-between gap-4">
                <h2 class="text-base font-semibold text-zinc-900">
                    New Arrivals
                </h2>

                <a
                    href="#"
                    wire:navigate
                    class="
                        group inline-flex shrink-0 items-center gap-1
                        text-xs font-medium text-micronix-600
                        transition hover:text-micronix-700
                    "
                >
                    View All New Arrivals

                    <flux:icon.arrow-right
                        class="
                            size-3.5
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
                @foreach ($latestProducts as $product)
                    <div
                        wire:key="new-arrival-{{ $product->public_id }}"
                        class="
                            min-w-0
                            flex-[0_0_70%]
                            pr-2
                            sm:flex-[0_0_33.333%]
                            md:flex-[0_0_25%]
                            lg:flex-[0_0_16.6667%]
                        "
                    >
                        @include(
                            'partials.frontend.products.product-card-v2',
                            [
                                'product' => $product,
                                'badge' => 'New',
                            ]
                        )
                    </div>
                @endforeach
            </x-frontend.carousel>

        </div>
    </section>
@endif