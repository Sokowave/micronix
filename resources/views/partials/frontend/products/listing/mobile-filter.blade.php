{{-- Mobile Filters --}}
<flux:modal
    name="product-filters"
    variant="flyout"
    position="left"
    class="w-full max-w-sm"
>
    {{-- Header --}}
    <div class="mb-3">
        <flux:heading size="lg">Product Filters</flux:heading>
    </div>

    {{-- Filters --}}
    @include('partials.frontend.products.listing.filters')
</flux:modal>