{{-- resources/views/partials/frontend/products/show/sidebar/features.blade.php --}}

@php
    $features = [
        'Intel Core i7 11th Generation Processor',
        '16GB DDR4 RAM',
        '512GB NVMe SSD Storage',
        '14-inch Full HD Display',
        'Intel Iris Xe Graphics',
        'Windows 11 Pro',
    ];
@endphp

<div>
    <h2 class="text-sm font-semibold text-zinc-900">
        Key Features
    </h2>

    <ul class="mt-3 grid gap-x-6 gap-y-2.5 sm:grid-cols-2">
        @foreach ($features as $feature)
            <li class="flex items-start gap-2 text-xs leading-5 text-zinc-600">
                <flux:icon.check
                    class="mt-0.5 size-4 shrink-0 text-micronix-500"
                />

                <span>{{ $feature }}</span>
            </li>
        @endforeach
    </ul>
</div>