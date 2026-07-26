{{-- resources/views/partials/frontend/home/deal-of-the-day/products.blade.php --}}

<div class="min-w-0 lg:col-span-3">
    <x-frontend.carousel
        type="products"
        :autoplay="false"
        :loop="false"
        :dots="false"
        :navigation="true"
    >
        {{-- Product 1 --}}
        <div
            class="
                min-w-0 flex-[0_0_75%]
                border-l-4 border-micronix-100
                sm:flex-[0_0_50%]
                lg:flex-[0_0_25%]
            "
        >
            @include(
                'partials.frontend.home.deal-of-the-day.product',
                [
                    'name' => 'Logitech MX Master 3S',
                    'image' => 'https://placehold.co/400x400',
                    'price' => '15,500',
                    'oldPrice' => '18,000',
                    'discount' => '15%',
                ]
            )
        </div>

        {{-- Product 2 --}}
        <div
            class="
                min-w-0 flex-[0_0_75%]
                border-l-4 border-micronix-100
                sm:flex-[0_0_50%]
                lg:flex-[0_0_25%]
            "
        >
            @include(
                'partials.frontend.home.deal-of-the-day.product',
                [
                    'name' => 'TP-Link Archer AX23',
                    'image' => 'https://placehold.co/400x400',
                    'price' => '9,000',
                    'oldPrice' => '10,000',
                    'discount' => '10%',
                ]
            )
        </div>

        {{-- Product 3 --}}
        <div
            class="
                min-w-0 flex-[0_0_75%]
                border-l-4 border-micronix-100
                sm:flex-[0_0_50%]
                lg:flex-[0_0_25%]
            "
        >
            @include(
                'partials.frontend.home.deal-of-the-day.product',
                [
                    'name' => 'Kingston 1TB NV2 SSD',
                    'image' => 'https://placehold.co/400x400',
                    'price' => '9,500',
                    'oldPrice' => '11,800',
                    'discount' => '20%',
                ]
            )
        </div>

        {{-- Product 4 --}}
        <div
            class="
                min-w-0 flex-[0_0_75%]
                border-l-4 border-micronix-100
                sm:flex-[0_0_50%]
                lg:flex-[0_0_25%]
            "
        >
            @include(
                'partials.frontend.home.deal-of-the-day.product',
                [
                    'name' => 'Samsung 27 Inch Odyssey G5',
                    'image' => 'https://placehold.co/400x400',
                    'price' => '41,999',
                    'oldPrice' => '45,000',
                    'discount' => '7%',
                ]
            )
        </div>

        {{-- Product 5 --}}
        <div
            class="
                min-w-0 flex-[0_0_75%]
                border-l-4 border-micronix-100
                sm:flex-[0_0_50%]
                lg:flex-[0_0_25%]
            "
        >
            @include(
                'partials.frontend.home.deal-of-the-day.product',
                [
                    'name' => 'HP Wireless Keyboard & Mouse',
                    'image' => 'https://placehold.co/400x400',
                    'price' => '6,500',
                    'oldPrice' => '8,000',
                    'discount' => '19%',
                ]
            )
        </div>
    </x-frontend.carousel>
</div>