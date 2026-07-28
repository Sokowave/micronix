{{-- resources/views/partials/frontend/products/listing/toolbar.blade.php --}}

<div
    class="
        flex flex-col md:flex-row min-h-12
        items-center justify-between
        gap-3
        border-y border-zinc-200
        py-2
    "
>

    @include('partials.frontend.products.listing.toolbar.results')

    @include('partials.frontend.products.listing.toolbar.actions')

</div>