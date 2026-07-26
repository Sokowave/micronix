{{-- resources/views/partials/frontend/products/listing/filters/price.blade.php --}}

<div class="py-5">
    <h3 class="mb-3 text-sm font-semibold text-zinc-900">
        Price
    </h3>

    {{-- Price Inputs --}}
    <div class="grid grid-cols-[1fr_auto_1fr] items-center gap-2">

        {{-- Minimum --}}
        <div>
            <label
                for="min-price"
                class="mb-1 block text-[10px] text-zinc-400"
            >
                Minimum
            </label>

            <div class="relative">
                <span
                    class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-medium text-zinc-400"
                >
                    KES
                </span>

                <input
                    id="min-price"
                    type="number"
                    min="0"
                    step="100"
                    wire:model.live.debounce.500ms="minPrice"
                    placeholder="0"
                    class="h-9 w-full rounded-lg border border-zinc-200 bg-white pl-9 pr-2 text-xs text-zinc-800 outline-none transition placeholder:text-zinc-400 focus:border-micronix-400 focus:ring-2 focus:ring-micronix-500/10"
                >
            </div>
        </div>

        <span class="mt-5 text-zinc-300">
            —
        </span>

        {{-- Maximum --}}
        <div>
            <label
                for="max-price"
                class="mb-1 block text-[10px] text-zinc-400"
            >
                Maximum
            </label>

            <div class="relative">
                <span
                    class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-medium text-zinc-400"
                >
                    KES
                </span>

                <input
                    id="max-price"
                    type="number"
                    min="0"
                    step="100"
                    wire:model.live.debounce.500ms="maxPrice"
                    placeholder="Any"
                    class="h-9 w-full rounded-lg border border-zinc-200 bg-white pl-9 pr-2 text-xs text-zinc-800 outline-none transition placeholder:text-zinc-400 focus:border-micronix-400 focus:ring-2 focus:ring-micronix-500/10"
                >
            </div>
        </div>

    </div>

    {{-- Quick Price Ranges --}}
    <div class="mt-3 flex flex-wrap gap-1.5">
        @foreach ([
            [null, 25000, 'Under 25K'],
            [25000, 50000, '25K–50K'],
            [50000, 100000, '50K–100K'],
            [100000, null, '100K+'],
        ] as [$min, $max, $label])
            <button
                type="button"
                wire:click="setPriceRange({{ $min ?? 'null' }}, {{ $max ?? 'null' }})"
                wire:loading.attr="disabled"
                class="
                    cursor-pointer rounded-full
                    border border-zinc-200
                    px-2.5 py-1
                    text-[10px] font-medium
                    text-zinc-500
                    transition
                    hover:border-micronix-200
                    hover:bg-micronix-50
                    hover:text-micronix-600
                    disabled:cursor-wait
                    disabled:opacity-50
                "
            >
                {{ $label }}
            </button>
        @endforeach
    </div>
</div>
