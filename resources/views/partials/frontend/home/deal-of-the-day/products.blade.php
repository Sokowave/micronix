{{-- resources/views/partials/frontend/home/deal-of-the-day/products.blade.php --}}

<div class="mt-1 min-w-0 lg:col-span-3 lg:mt-0">
    @if ($products->isNotEmpty())
        <x-frontend.carousel
            type="products"
            :autoplay="true"
            :loop="$products->count() > 1"
            :dots="false"
            :navigation="$products->count() > 1"
        >
            @foreach ($products as $product)
                <div
                    wire:key="deal-product-{{ $product->public_id }}"
                    class="
                        min-w-0 flex-[0_0_75%]
                        border-l-4 border-micronix-100
                        sm:flex-[0_0_50%]
                        lg:flex-[0_0_25%]
                    "
                >
                    @include('partials.frontend.home.deal-of-the-day.product', [
                        'product' => $product,
                    ])
                </div>
            @endforeach
        </x-frontend.carousel>
    @endif
</div>