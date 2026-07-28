{{-- resources/views/partials/frontend/products/listing/header.blade.php --}}

<section class="bg-white">
    <div class="mx-auto max-w-7xl px-4 py-5 xl:px-6">

        @include('partials.frontend.products.listing.breadcrumb')

        {{-- Heading --}}
        @include('partials.frontend.products.listing.header.title')

        {{-- Child Categories --}}
        @include('partials.frontend.products.listing.header.child-categories')

    </div>
</section>