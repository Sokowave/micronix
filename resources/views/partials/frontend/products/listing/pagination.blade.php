{{-- resources/views/partials/frontend/products/listing/pagination.blade.php --}}

@if ($products->hasPages())
    @php
        $current = $products->currentPage();
        $last = $products->lastPage();
        $start = max(1, $current - 1);
        $end = min($last, $current + 1);

        $button = 'flex size-10 cursor-pointer items-center justify-center rounded-lg border border-zinc-200 bg-white text-sm text-zinc-600 transition hover:border-micronix-300 hover:text-micronix-600 disabled:cursor-not-allowed disabled:bg-zinc-50 disabled:text-zinc-300';
    @endphp

    <div class="mt-8 flex flex-col items-center gap-4 border-t border-zinc-200 pt-5">

        {{-- Results --}}
        <p class="text-sm text-zinc-500">
            Showing
            <span class="text-zinc-900">{{ number_format($products->firstItem()) }}</span>
            to
            <span class="text-zinc-900">{{ number_format($products->lastItem()) }}</span>
            of
            <span class="font-medium text-zinc-900">{{ number_format($products->total()) }}</span>
            results
        </p>

        {{-- Pagination --}}
        <nav
            class="flex items-center gap-1.5"
            aria-label="Pagination"
        >
            {{-- First --}}
            <button
                type="button"
                wire:click="gotoPage(1)"
                @disabled($products->onFirstPage())
                class="{{ $button }}"
                aria-label="First page"
            >
                <flux:icon.chevron-double-left class="size-4" />
            </button>

            {{-- Previous --}}
            <button
                type="button"
                wire:click="previousPage"
                @disabled($products->onFirstPage())
                class="{{ $button }}"
                aria-label="Previous page"
            >
                <flux:icon.chevron-left class="size-4" />
            </button>

            {{-- Pages --}}
            @if ($start > 1)
                <button
                    type="button"
                    wire:click="gotoPage(1)"
                    class="{{ $button }}"
                >
                    1
                </button>

                @if ($start > 2)
                    <span class="flex size-10 items-center justify-center text-zinc-400">
                        …
                    </span>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                <button
                    type="button"
                    wire:click="gotoPage({{ $page }})"
                    wire:key="page-{{ $page }}"
                    @class([
                        $button,
                        '!border-micronix-600 !bg-micronix-600 !text-white' => $page === $current,
                    ])
                    aria-current="{{ $page === $current ? 'page' : 'false' }}"
                >
                    {{ $page }}
                </button>
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <span class="flex size-10 items-center justify-center text-zinc-400">
                        …
                    </span>
                @endif

                <button
                    type="button"
                    wire:click="gotoPage({{ $last }})"
                    class="{{ $button }}"
                >
                    {{ $last }}
                </button>
            @endif

            {{-- Next --}}
            <button
                type="button"
                wire:click="nextPage"
                @disabled(! $products->hasMorePages())
                class="{{ $button }}"
                aria-label="Next page"
            >
                <flux:icon.chevron-right class="size-4" />
            </button>

            {{-- Last --}}
            <button
                type="button"
                wire:click="gotoPage({{ $last }})"
                @disabled(! $products->hasMorePages())
                class="{{ $button }}"
                aria-label="Last page"
            >
                <flux:icon.chevron-double-right class="size-4" />
            </button>
        </nav>

    </div>
@endif