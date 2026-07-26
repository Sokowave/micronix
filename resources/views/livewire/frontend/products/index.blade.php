<div>
    @include('partials.frontend.products.listing.header')

    <section class="pb-10">
        <div class="mx-auto max-w-7xl px-2 xl:px-6">

            @include('partials.frontend.products.listing.toolbar')

            <div class="mt-4 flex items-start gap-4">

                {{-- Desktop filters --}}
                <aside class="hidden w-64 shrink-0 lg:block">
                    @include('partials.frontend.products.listing.filters')
                </aside>

                {{-- Products --}}
                <div class="min-w-0 flex-1">

                    @include('partials.frontend.products.listing.active-filters')

                    @include('partials.frontend.products.listing.products-grid')

                    @include('partials.frontend.products.listing.pagination')

                </div>

            </div>

        </div>
    </section>

    {{-- Mobile Filters --}}
    @include('partials.frontend.products.listing.mobile-filter')
</div>