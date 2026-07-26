{{-- resources/views/partials/frontend/products/listing/filters/clear.blade.php --}}

@if (
    ! empty($brands) ||
    ! empty($conditions) ||
    $inStock ||
    $minPrice !== null ||
    $maxPrice !== null
)
    <div class="pt-5">
        <button
            type="button"
            wire:click="clearFilters"
            wire:loading.attr="disabled"
            class="
                flex h-9 w-full
                cursor-pointer
                items-center justify-center
                gap-2 rounded-lg
                border border-zinc-200
                bg-white
                text-xs font-semibold
                text-zinc-600
                transition
                hover:border-micronix-200
                hover:bg-micronix-50
                hover:text-micronix-600
                disabled:cursor-wait
                disabled:opacity-50
            "
        >
            <flux:icon.x-mark class="size-3.5" />

            <span wire:loading.remove wire:target="clearFilters">
                Clear Filters
            </span>

            <span wire:loading wire:target="clearFilters">
                Clearing...
            </span>
        </button>
    </div>
@endif
