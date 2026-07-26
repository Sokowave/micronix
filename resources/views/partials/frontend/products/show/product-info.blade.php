{{-- resources/views/partials/frontend/products/show/product-info.blade.php --}}

<div class="flex h-full min-w-0 flex-col">

    @include('partials.frontend.products.show.product-info.header')

    @include('partials.frontend.products.show.product-info.meta')

    @include('partials.frontend.products.show.product-info.pricing')

    <div class="mt-5">
        @include('partials.frontend.products.show.actions')
    </div>

</div>