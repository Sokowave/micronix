{{-- resources/views/partials/frontend/products/listing/toolbar.blade.php --}}

<div
    class="
        flex min-h-12
        items-center justify-between
        gap-3
        border-y border-zinc-200
        py-2
    "
>
    {{-- ========================================================= --}}
    {{-- Results                                                   --}}
    {{-- ========================================================= --}}

    <div class="min-w-0">
        <p class="text-xs text-zinc-500 sm:text-sm">
            <span class="font-semibold text-zinc-900">
                {{ number_format($products->total()) }}
            </span>

            <span>
                {{ Str::plural('product', $products->total()) }}
            </span>
        </p>
    </div>

    {{-- ========================================================= --}}
    {{-- Actions                                                   --}}
    {{-- ========================================================= --}}

    <div class="flex shrink-0 items-center gap-2">

        {{-- Mobile Filters --}}
        <flux:modal.trigger name="product-filters">
            <button
                type="button"
                class="
                    inline-flex h-9 cursor-pointer
                    items-center justify-center gap-2
                    rounded-lg
                    border border-zinc-200
                    bg-white px-3
                    text-xs font-medium
                    text-zinc-700
                    transition
                    hover:border-zinc-300
                    hover:bg-zinc-50
                    lg:hidden
                "
            >
                <flux:icon.adjustments-horizontal class="size-4" />

                <span>
                    Filters
                </span>

                @php
                    $activeFilterCount =
                        count($brands ?? []) +
                        count($conditions ?? []) +
                        (! empty($inStock) ? 1 : 0) +
                        ($minPrice !== null ? 1 : 0) +
                        ($maxPrice !== null ? 1 : 0);
                @endphp

                @if ($activeFilterCount > 0)
                    <span
                        class="
                            flex size-5 items-center justify-center
                            rounded-full
                            bg-micronix-600
                            text-[9px] font-bold
                            text-white
                        "
                    >
                        {{ $activeFilterCount }}
                    </span>
                @endif
            </button>
        </flux:modal.trigger>

        {{-- Sort Label --}}
        <span class="hidden text-xs text-zinc-500 sm:inline">
            Sort by:
        </span>

        {{-- Sort --}}
        <div class="w-[145px] sm:w-[170px]">
            <flux:select
                wire:model.live="sort"
                size="sm"
                aria-label="Sort products"
            >
                <flux:select.option value="featured">
                    Featured
                </flux:select.option>

                <flux:select.option value="newest">
                    Newest
                </flux:select.option>

                <flux:select.option value="price_asc">
                    Price: Low to High
                </flux:select.option>

                <flux:select.option value="price_desc">
                    Price: High to Low
                </flux:select.option>

                <flux:select.option value="name_asc">
                    Name: A–Z
                </flux:select.option>
            </flux:select>
        </div>

        {{-- ===================================================== --}}
        {{-- View Switcher                                         --}}
        {{-- ===================================================== --}}

        <div
            class="
                hidden items-center
                rounded-lg border border-zinc-200
                bg-white p-0.5
                sm:flex
            "
        >
            {{-- Grid --}}
            <button
                type="button"
                aria-label="Grid view"
                title="Grid view"
                class="
                    flex size-8 cursor-pointer
                    items-center justify-center
                    rounded-md
                    bg-micronix-50
                    text-micronix-600
                    transition
                    hover:bg-micronix-100
                "
            >
                <flux:icon.squares-2x2 class="size-4" />
            </button>

            {{-- List --}}
            <button
                type="button"
                aria-label="List view"
                title="List view"
                class="
                    flex size-8 cursor-pointer
                    items-center justify-center
                    rounded-md
                    text-zinc-400
                    transition
                    hover:bg-zinc-50
                    hover:text-zinc-700
                "
            >
                <flux:icon.list-bullet class="size-4" />
            </button>
        </div>

    </div>
</div>