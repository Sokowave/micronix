{{-- resources/views/partials/frontend/products/show/sidebar/trust.blade.php --}}

@php
    $items = [
        [
            'icon' => 'truck',
            'title' => 'Fast Delivery',
            'description' => 'Countrywide',
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Warranty',
            'description' => '12 Months',
        ],
        [
            'icon' => 'lock-closed',
            'title' => 'Secure Payment',
            'description' => 'Safe checkout',
        ],
    ];
@endphp

<div
    class="
        mt-5 divide-y divide-zinc-200
        overflow-hidden rounded-xl
        border border-zinc-200
        bg-zinc-50/70
        px-3
    "
>
    @foreach ($items as $item)
        <div class="flex min-w-0 items-center gap-3 py-3">
            <div
                class="
                    flex size-9 shrink-0
                    items-center justify-center
                    rounded-lg bg-white
                    text-micronix-600
                    shadow-sm
                "
            >
                <flux:icon
                    :name="$item['icon']"
                    class="size-4"
                />
            </div>

            <div class="min-w-0 flex-1">
                <p
                    class="
                        truncate
                        text-xs font-semibold
                        text-zinc-800
                    "
                >
                    {{ $item['title'] }}
                </p>

                <p
                    class="
                        mt-0.5 truncate
                        text-[10px]
                        text-zinc-500
                    "
                >
                    {{ $item['description'] }}
                </p>
            </div>
        </div>
    @endforeach
</div>