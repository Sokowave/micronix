{{-- resources/views/partials/frontend/products/show/specifications.blade.php --}}

@if ($product->specifications->isNotEmpty())

<section
    id="product-specifications"
    class="scroll-mt-24"
>
    {{-- ========================================================= --}}
    {{-- Section Header                                            --}}
    {{-- ========================================================= --}}

    <div class="mb-5">
        <h2 class="text-xl font-bold tracking-tight text-zinc-950">
            Specifications
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Technical details and specifications for this product.
        </p>
    </div>

    {{-- ========================================================= --}}
    {{-- Specifications                                            --}}
    {{-- ========================================================= --}}

    <div
        class="
            overflow-hidden rounded-xl
            border border-zinc-200
            bg-white
        "
    >
        <dl class="divide-y divide-zinc-200">

            @foreach ($product->specifications->sortBy('name') as $specification)

                <div
                    class="
                        grid
                        sm:grid-cols-[240px_1fr]
                    "
                >
                    {{-- Specification --}}
                    <dt
                        class="
                            flex items-center gap-2
                            border-r border-zinc-200
                            bg-zinc-50
                            px-5 py-4
                            text-sm font-medium
                            text-zinc-700
                        "
                    >
                        @if ($specification->icon)
                            <flux:icon
                                :name="$specification->icon"
                                class="size-4 shrink-0 text-micronix-600"
                            />
                        @endif

                        <span>
                            {{ $specification->name }}
                        </span>
                    </dt>

                    {{-- Value --}}
                    <dd
                        class="
                            px-5 py-4
                            text-sm
                            leading-6
                            text-zinc-900
                        "
                    >
                        {{ filled($specification->pivot->value)
                            ? $specification->pivot->value
                            : '—' }}
                    </dd>
                </div>

            @endforeach

        </dl>
    </div>

    {{-- ========================================================= --}}
    {{-- Disclaimer                                                --}}
    {{-- ========================================================= --}}

    <p class="mt-3 text-[10px] leading-4 text-zinc-400">
        Product specifications may vary depending on configuration.
        Please confirm specific requirements before placing your order.
    </p>

</section>

@endif