{{-- resources/views/partials/frontend/products/listing/products-grid.blade.php --}}

@if ($products->isNotEmpty())
    <div
        class="
            gap-2
            grid 
            grid-cols-2   
            sm:grid-cols-3         
            md:grid-cols-4
            lg:grid-cols-4
            3xl:grid-cols-6
        "
    >
        @foreach ($products as $product)
            @include(
                'partials.frontend.products.listing.product-card',
                ['product' => $product]
            )
        @endforeach
    </div>
@else
    <div
        class="
            flex min-h-80 flex-col
            items-center justify-center
            rounded-lg border border-zinc-200
            bg-white px-6 text-center
        "
    >
        <flux:icon.magnifying-glass
            class="size-8 text-zinc-300"
        />

        <h3 class="mt-3 text-sm font-semibold text-zinc-900">
            No products found
        </h3>

        <p class="mt-1 max-w-sm text-xs text-zinc-500">
            Try changing your filters to find more products.
        </p>

        <button
            type="button"
            wire:click="clearFilters"
            class="
                mt-4 cursor-pointer
                text-xs font-semibold
                text-micronix-600
                transition
                hover:text-micronix-700
            "
        >
            Clear all filters
        </button>
    </div>
@endif