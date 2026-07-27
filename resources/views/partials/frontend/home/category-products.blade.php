{{-- resources/views/partials/frontend/home/category-products.blade.php --}}

<div class="min-w-0">
    {{-- Header --}}
    <div class="mb-4 flex items-center justify-between gap-4">
        <h2 class="truncate text-base font-semibold text-zinc-900">
            {{ $category->name }}
        </h2>

        <a
            href="{{ route('categories.show', $category->slug) }}"
            class="
                inline-flex shrink-0 items-center gap-1
                text-sm font-medium text-micronix-600
                transition hover:text-micronix-700
            "
        >
            View All

            <flux:icon.chevron-right class="size-4" />
        </a>
    </div>

    {{-- Products --}}
    <x-frontend.carousel
        type="products"
        :loop="$products->count() > 4"
        navigation
        class="w-full"
    >
        @foreach ($products as $product)
            <div
                wire:key="category-{{ $category->public_id }}-product-{{ $product->public_id }}"
                class="
                    min-w-0
                    pr-3
                    flex-[0_0_50%]
                    sm:flex-[0_0_33.333333%]
                    md:flex-[0_0_25%]
                    lg:flex-[0_0_33.333333%]
                    xl:flex-[0_0_25%]
                "
            >
                @include('partials.frontend.products.product-card-v3', [
                    'product' => $product,
                ])
            </div>
        @endforeach
    </x-frontend.carousel>
</div>