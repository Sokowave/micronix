{{-- resources/views/partials/frontend/products/listing/toolbar/sort.blade.php --}}

<flux:dropdown align="end" position="bottom">

    <flux:button
        variant="ghost"
        
        icon:trailing="chevron-down"
        class="min-w-52 justify-between cursor-pointer hover:text-micronix-500"
    >
        <span class="text-zinc-500">
            Sort by:
        </span>
        <span class="font-medium text-zinc-900">
        @switch($sort)
            @case('newest') Newest @break
            @case('price_asc') Price: Low to High @break
            @case('price_desc') Price: High to Low @break
            @case('name_asc') Name: A–Z @break
            @default Featured
        @endswitch
        </span>
    </flux:button>

    <flux:menu class="w-72 p-2">

        <div class="px-3 pt-2 pb-3">
            <p class="text-sm font-semibold text-zinc-900">
                Sort Products
            </p>

            <p class="mt-0.5 text-xs text-zinc-500">
                Choose how products are displayed.
            </p>
        </div>

        <flux:separator class="mb-2"/>

        @foreach ([
            'featured'   => 'Featured',
            'newest'     => 'Newest',
            'price_asc'  => 'Price: Low to High',
            'price_desc' => 'Price: High to Low',
            'name_asc'   => 'Name: A–Z',
        ] as $value => $label)

            <label
                class="
                    flex cursor-pointer items-center gap-3
                    rounded-xl px-3 py-3
                    transition-colors
                    hover:bg-zinc-50
                "
            >
                <input
                    type="radio"
                    wire:model.live="sort"
                    value="{{ $value }}"
                    class="
                        size-4
                        border-zinc-300
                        text-micronix-600
                        focus:ring-micronix-500
                    "
                >

                <span class="flex-1 text-sm font-medium text-zinc-700">
                    {{ $label }}
                </span>

                @if ($sort === $value)
                    <flux:icon.check class="size-4 text-micronix-600"/>
                @endif

            </label>

        @endforeach

    </flux:menu>

</flux:dropdown>