{{-- resources/views/livewire/frontend/collections/show.blade.php --}}

<div>
    {{-- Collection Header --}}
    <section class="border-b border-zinc-200 bg-zinc-50/50 py-6">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">
            <div class="flex items-center gap-5">

                {{-- Image --}}
                <div
                    class="
                        flex size-24 shrink-0
                        items-center justify-center
                        overflow-hidden rounded-xl
                        border border-zinc-200 bg-white p-3
                        sm:size-32
                    "
                >
                    <img
                        src="{{ $collection->media?->url ?? 'https://placehold.co/300x300' }}"
                        alt="{{ $collection->name }}"
                        class="h-full w-full object-contain"
                    >
                </div>

                {{-- Content --}}
                <div class="min-w-0">
                    <p class="mb-1 text-xs font-medium text-micronix-600">
                        Shop by Use Case
                    </p>

                    <h1 class="text-xl font-bold text-zinc-900 sm:text-2xl">
                        {{ $collection->name }}
                    </h1>

                    @if ($collection->description)
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-500">
                            {{ $collection->description }}
                        </p>
                    @endif

                    <p class="mt-2 text-xs text-zinc-400">
                        {{ $products->count() }}
                        {{ Str::plural('product', $products->count()) }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Products --}}
    <section class="py-6">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            <div class="mb-4 flex items-center justify-between gap-4">
                <h2 class="text-base font-semibold text-zinc-900">
                    Products
                </h2>

                <span class="text-xs text-zinc-500">
                    {{ $products->count() }} results
                </span>
            </div>

            @if ($products->isNotEmpty())
                <div
                    class="
                        grid grid-cols-2 gap-x-3 gap-y-6
                        sm:grid-cols-3
                        md:grid-cols-4
                        lg:grid-cols-5
                        xl:grid-cols-6
                    "
                >
                    @foreach ($products as $product)
                        <div
                            wire:key="collection-{{ $collection->public_id }}-product-{{ $product->public_id }}"
                            class="min-w-0"
                        >
                            @include('partials.frontend.products.product-card-v3', [
                                'product' => $product,
                            ])
                        </div>
                    @endforeach
                </div>
            @else
<div
    class="
        flex min-h-64 flex-col
        items-center justify-center
        rounded-xl border border-dashed
        border-zinc-200 bg-zinc-50
        px-6 text-center
    "
>
    <flux:icon.shopping-bag class="size-8 text-zinc-300" />

    <h2 class="mt-3 text-sm font-semibold text-zinc-900">
        No products available
    </h2>

    <p class="mt-1 max-w-sm text-xs leading-5 text-zinc-500">
        There are currently no products available in this collection.
    </p>

    <a
        href="{{ route('collections.index') }}"
        wire:navigate
        class="mt-4 inline-flex items-center gap-1 text-xs font-medium text-micronix-600 hover:text-micronix-700"
    >
        Browse other use cases

        <flux:icon.arrow-right class="size-3.5" />
    </a>
</div>
            @endif

        </div>
    </section>
</div>