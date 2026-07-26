
{{-- resources/views/partials/frontend/products/listing/filters/brands.blade.php --}}

@if ($filterBrands->isNotEmpty())
    <div class="py-5">
        <h3 class="mb-3 text-sm font-semibold text-zinc-900">
            Brand
        </h3>

        <div class="relative mb-3">
            <flux:icon.magnifying-glass
                class="pointer-events-none absolute left-3 top-1/2 size-3.5 -translate-y-1/2 text-zinc-400"
            />

            <input
                type="search"
                wire:model.live.debounce.300ms="brandSearch"
                placeholder="Search brands"
                class="h-9 w-full rounded-lg border border-zinc-200 bg-white pl-9 pr-3 text-xs text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-micronix-400 focus:ring-2 focus:ring-micronix-500/10"
            >
        </div>

        <div class="max-h-52 space-y-2.5 overflow-y-auto pr-1">
            @foreach ($filterBrands as $brand)
                <label
                    wire:key="brand-filter-{{ $brand->id }}"
                    class="flex cursor-pointer items-center justify-between gap-3"
                >
                    <span class="flex min-w-0 items-center gap-2.5">
                        <input
                            type="checkbox"
                            value="{{ $brand->slug }}"
                            wire:model.live="brands"
                            class="size-4 rounded border-zinc-300 text-micronix-600 focus:ring-micronix-500"
                        >

                        <span class="truncate text-xs text-zinc-600">
                            {{ $brand->name }}
                        </span>
                    </span>

                    <span class="text-[10px] text-zinc-400">
                        {{ $brand->products_count }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>
@endif
