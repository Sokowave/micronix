{{-- resources/views/partials/frontend/products/listing/filters/condition.blade.php --}}

<div class="py-5">
    <h3 class="mb-3 text-sm font-semibold text-zinc-900">
        Condition
    </h3>

    <div class="space-y-2.5">
        @foreach ([
            'new' => 'New',
            'refurbished' => 'Refurbished',
            'used' => 'Used',
        ] as $value => $label)
            <label
                wire:key="condition-filter-{{ $value }}"
                class="flex cursor-pointer items-center gap-2.5"
            >
                <input
                    type="checkbox"
                    value="{{ $value }}"
                    wire:model.live="conditions"
                    class="
                        size-4 rounded
                        border-zinc-300
                        text-micronix-600
                        focus:ring-micronix-500
                    "
                >

                <span class="text-xs text-zinc-600">
                    {{ $label }}
                </span>
            </label>
        @endforeach
    </div>
</div>
