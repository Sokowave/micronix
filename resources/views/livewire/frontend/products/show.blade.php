{{-- resources/views/livewire/frontend/products/show.blade.php --}}
@php
    $details = $product->details();
@endphp

<div class="bg-white">

    @include('partials.frontend.products.show.breadcrumbs')

    {{-- Product --}}
    <section class="sm:py-6">
        <div class="mx-auto max-w-7xl px-2 xl:px-6">

            <div
                class="
                   grid gap-4 lg:grid-cols-[600fr_650fr_400fr]
                "
            >
                {{-- Gallery --}}
                <div class="min-w-0">
                    @include('partials.frontend.products.show.gallery')
                </div>

                {{-- Product Information --}}
                <div class="min-w-0">
                    @include('partials.frontend.products.show.product-info')
                </div>

                {{-- Actions --}}
                <aside class="min-w-0">
                    <div
                        class="
                            rounded-xl
                            border border-zinc-200
                            bg-white p-4
                            lg:sticky lg:top-24
                        "
                    >
                        @include('partials.frontend.products.show.sidebar')
                    </div>
                </aside>
            </div>

        </div>
    </section>

    {{-- Product Details --}}
    <section class="border-t border-zinc-200 bg-zinc-50/50 py-8 sm:py-10">
        <div class="mx-auto max-w-7xl px-2 xl:px-6">

            <div
                class="
                    grid grid-cols-1
                    items-start gap-6
                    lg:grid-cols-12
                    lg:gap-8
                "
            >
                {{-- Description --}}
                <div class="min-w-0 lg:col-span-7">
                    @include('partials.frontend.products.show.description')
                </div>

                {{-- Specifications --}}
                <div class="min-w-0 lg:col-span-5">
                    @include('partials.frontend.products.show.specifications')
                </div>
            </div>

        </div>
    </section>

    {{-- Related Products --}}
    @include('partials.frontend.products.show.related-products')

</div>