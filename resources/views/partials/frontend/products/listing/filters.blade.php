{{-- resources/views/partials/frontend/products/listing/filters.blade.php --}}

<div class="divide-y divide-zinc-200">
    @include('partials.frontend.products.listing.filters.categories')

    @include('partials.frontend.products.listing.filters.brands')

    @include('partials.frontend.products.listing.filters.price')

    @include('partials.frontend.products.listing.filters.condition')

    @include('partials.frontend.products.listing.filters.availability')

    @include('partials.frontend.products.listing.filters.clear')
</div>
