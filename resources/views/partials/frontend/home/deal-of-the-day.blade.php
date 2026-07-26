{{-- resources/views/partials/frontend/home/deal-of-the-day.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <div
            class="
                grid overflow-hidden rounded-xl
                border-4 border-micronix-100
                bg-micronix-100
                lg:grid-cols-5
            "
        >
            <div class="lg:col-span-2">
                @include('partials.frontend.home.deal-of-the-day.header')

                @include('partials.frontend.home.deal-of-the-day.featured')
            </div>

            @include('partials.frontend.home.deal-of-the-day.products')
        </div>

    </div>
</section>