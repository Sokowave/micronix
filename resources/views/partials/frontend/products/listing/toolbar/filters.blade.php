{{-- resources/views/partials/frontend/products/listing/toolbar/filters.blade.php --}}

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