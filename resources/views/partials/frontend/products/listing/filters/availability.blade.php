{{-- resources/views/partials/frontend/products/listing/filters/availability.blade.php --}}

<div class="py-5">
    <h3 class="mb-3 text-sm font-semibold text-zinc-900">
        Availability
    </h3>

    <label class="flex cursor-pointer items-center justify-between gap-3">
        <span class="flex items-center gap-2.5">
            <input
                type="checkbox"
                wire:model.live="inStock"
                class="
                    size-4 rounded
                    border-zinc-300
                    text-micronix-600
                    focus:ring-micronix-500
                "
            >

            <span class="text-xs text-zinc-600">
                In Stock Only
            </span>
        </span>

        <span class="flex items-center gap-1 text-[10px] font-medium text-emerald-600">
            <span class="size-1.5 rounded-full bg-emerald-500"></span>

            Available
        </span>
    </label>
</div>
