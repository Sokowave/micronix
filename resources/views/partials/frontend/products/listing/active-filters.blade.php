{{-- resources/views/partials/frontend/products/listing/active-filters.blade.php --}}

@php
    $hasActiveFilters =
        ! empty($brands) ||
        ! empty($conditions) ||
        ! empty($inStock) ||
        $minPrice !== null ||
        $maxPrice !== null;
@endphp

@if ($hasActiveFilters)
    <div
        class="
            mb-4 flex flex-wrap
            items-center gap-2
        "
    >
        {{-- Label --}}
        <span class="mr-1 text-xs font-medium text-zinc-500">
            Active filters:
        </span>

        {{-- ===================================================== --}}
        {{-- Brands                                                --}}
        {{-- ===================================================== --}}

        @foreach ($brands as $brand)
            <button
                type="button"
                wire:click="$set('brands', {{ \Illuminate\Support\Js::from(
                    array_values(array_filter(
                        $brands,
                        fn ($item) => $item !== $brand
                    ))
                ) }})"
                wire:key="active-brand-{{ $brand }}"
                class="
                    group inline-flex h-8
                    cursor-pointer items-center gap-1.5
                    rounded-full
                    border border-micronix-200
                    bg-micronix-50
                    px-3
                    text-[11px] font-medium
                    text-micronix-700
                    transition
                    hover:border-micronix-300
                    hover:bg-micronix-100
                "
            >
                <span>
                    {{ Str::headline($brand) }}
                </span>

                <flux:icon.x-mark
                    class="
                        size-3.5
                        text-micronix-400
                        transition
                        group-hover:text-micronix-700
                    "
                />
            </button>
        @endforeach

        {{-- ===================================================== --}}
        {{-- Conditions                                            --}}
        {{-- ===================================================== --}}

        @foreach ($conditions as $condition)
            <button
                type="button"
                wire:click="$set('conditions', {{ \Illuminate\Support\Js::from(
                    array_values(array_filter(
                        $conditions,
                        fn ($item) => $item !== $condition
                    ))
                ) }})"
                wire:key="active-condition-{{ $condition }}"
                class="
                    group inline-flex h-8
                    cursor-pointer items-center gap-1.5
                    rounded-full
                    border border-zinc-200
                    bg-white
                    px-3
                    text-[11px] font-medium
                    text-zinc-700
                    transition
                    hover:border-micronix-200
                    hover:bg-micronix-50
                    hover:text-micronix-700
                "
            >
                <span>
                    {{ Str::headline($condition) }}
                </span>

                <flux:icon.x-mark
                    class="
                        size-3.5
                        text-zinc-400
                        transition
                        group-hover:text-micronix-600
                    "
                />
            </button>
        @endforeach

        {{-- ===================================================== --}}
        {{-- Availability                                          --}}
        {{-- ===================================================== --}}

        @if ($inStock)
            <button
                type="button"
                wire:click="$set('inStock', false)"
                class="
                    group inline-flex h-8
                    cursor-pointer items-center gap-1.5
                    rounded-full
                    border border-zinc-200
                    bg-white
                    px-3
                    text-[11px] font-medium
                    text-zinc-700
                    transition
                    hover:border-micronix-200
                    hover:bg-micronix-50
                    hover:text-micronix-700
                "
            >
                <span>
                    In Stock
                </span>

                <flux:icon.x-mark
                    class="
                        size-3.5
                        text-zinc-400
                        transition
                        group-hover:text-micronix-600
                    "
                />
            </button>
        @endif

        {{-- ===================================================== --}}
        {{-- Minimum Price                                         --}}
        {{-- ===================================================== --}}

        @if ($minPrice !== null)
            <button
                type="button"
                wire:click="$set('minPrice', null)"
                class="
                    group inline-flex h-8
                    cursor-pointer items-center gap-1.5
                    rounded-full
                    border border-zinc-200
                    bg-white
                    px-3
                    text-[11px] font-medium
                    text-zinc-700
                    transition
                    hover:border-micronix-200
                    hover:bg-micronix-50
                    hover:text-micronix-700
                "
            >
                <span>
                    From KES {{ number_format($minPrice) }}
                </span>

                <flux:icon.x-mark
                    class="
                        size-3.5
                        text-zinc-400
                        transition
                        group-hover:text-micronix-600
                    "
                />
            </button>
        @endif

        {{-- ===================================================== --}}
        {{-- Maximum Price                                         --}}
        {{-- ===================================================== --}}

        @if ($maxPrice !== null)
            <button
                type="button"
                wire:click="$set('maxPrice', null)"
                class="
                    group inline-flex h-8
                    cursor-pointer items-center gap-1.5
                    rounded-full
                    border border-zinc-200
                    bg-white
                    px-3
                    text-[11px] font-medium
                    text-zinc-700
                    transition
                    hover:border-micronix-200
                    hover:bg-micronix-50
                    hover:text-micronix-700
                "
            >
                <span>
                    Up to KES {{ number_format($maxPrice) }}
                </span>

                <flux:icon.x-mark
                    class="
                        size-3.5
                        text-zinc-400
                        transition
                        group-hover:text-micronix-600
                    "
                />
            </button>
        @endif

        {{-- ===================================================== --}}
        {{-- Clear All                                             --}}
        {{-- ===================================================== --}}

        <button
            type="button"
            wire:click="clearFilters"
            wire:loading.attr="disabled"
            class="
                ml-1 cursor-pointer
                text-[11px] font-semibold
                text-zinc-500
                underline decoration-zinc-300
                underline-offset-4
                transition
                hover:text-micronix-600
                hover:decoration-micronix-300
                disabled:cursor-wait
                disabled:opacity-50
            "
        >
            Clear all
        </button>
    </div>
@endif