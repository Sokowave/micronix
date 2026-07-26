{{-- resources/views/livewire/frontend/home.blade.php --}}

<div>
    @include('partials.frontend.home.hero')

    @include('partials.frontend.home.categories')

    @include('partials.frontend.home.benefits')

    @include('partials.frontend.home.featured-products')

    @include('partials.frontend.home.promo-banners')

    @include('partials.frontend.home.deal-of-the-day')

   {{-- Laptops + Computer Components --}}
    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            <div class="grid gap-6 lg:grid-cols-2">
                @include('partials.frontend.home.laptops-computers')

                @include('partials.frontend.home.computer-components')
            </div>

        </div>
    </section>

    @include('partials.frontend.home.use-cases')

    @include('partials.frontend.home.new-arrivals')

    @include('partials.frontend.home.workspace-banner')

    @include('partials.frontend.home.brands')

    @include('partials.frontend.home.why-micronix')
</div>