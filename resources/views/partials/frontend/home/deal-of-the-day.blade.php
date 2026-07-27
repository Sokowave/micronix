{{-- resources/views/partials/frontend/home/deal-of-the-day.blade.php --}}

@if ($deal && $deal->products->isNotEmpty())
    @php
        $featuredProduct = $deal->products->random();

        $carouselProducts = $deal->products->reject(
            fn ($product) => $product->id === $featuredProduct->id
        );
    @endphp

    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            <div
                class="
                    grid overflow-hidden rounded-xl
                    border-4 border-micronix-100
                    bg-micronix-100
                    lg:grid-cols-5
                "
            >
                {{-- Featured Product --}}
                <div class="lg:col-span-2">
                    @include('partials.frontend.home.deal-of-the-day.header', [
                        'deal' => $deal,
                        'product' => $featuredProduct,
                    ])

                    @include('partials.frontend.home.deal-of-the-day.featured', [
                        'product' => $featuredProduct,
                    ])
                </div>

                {{-- Remaining Deal Products --}}
                @include('partials.frontend.home.deal-of-the-day.products', [
                    'products' => $carouselProducts,
                ])
            </div>

        </div>
    </section>
@endif