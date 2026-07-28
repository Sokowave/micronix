{{-- resources/views/livewire/frontend/seo-landing-page/show.blade.php --}}

<div>
    <section class="py-6 md:py-8">
        <div class="mx-auto max-w-7xl px-2 xl:px-6">

            {{-- Page heading --}}
            <div class="mb-5">
                <h1 class="text-xl font-semibold text-gray-900 md:text-2xl">
                    {{ $landingPage->h1 }}
                </h1>

                @if ($landingPage->intro)
                    <p class="mt-2 text-sm leading-6 text-gray-600">
                        {{ $landingPage->intro }}
                    </p>
                @endif
            </div>

            {{-- Products --}}
            @if ($products->isNotEmpty())
                <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @foreach ($products as $product)
                        <div wire:key="product-{{ $product->id }}">
                            @include('partials.frontend.products.product-card-v1', [
                                'product' => $product,
                            ])
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($products->hasPages())
                    @include('partials.frontend.products.listing.pagination')
                @endif
            @else
                <div class="py-12 text-center">
                    <p class="text-sm text-gray-500">
                        No products are currently available in this collection.
                    </p>
                </div>
            @endif

        </div>
    </section>
</div>