{{-- resources/views/partials/frontend/header/search/suggestions.blade.php --}}

@php
    $hasSuggestions =
        $suggestions['tags']->isNotEmpty() ||
        $suggestions['categories']->isNotEmpty() ||
        $suggestions['products']->isNotEmpty();
@endphp

<div
    id="header-search-suggestions"
    x-ref="suggestions"
    role="listbox"
    class="absolute left-0 right-0 top-full z-50 mt-2 max-h-[70vh] overflow-y-auto rounded-xl border border-zinc-200 bg-white shadow-xl"
>
    @if ($hasSuggestions)

        @include('partials.frontend.header.search.tags')

        @include('partials.frontend.header.search.categories')

        @include('partials.frontend.header.search.products')

        <a
            href="{{ route('search', ['q' => $q]) }}"
            wire:navigate
            class="flex items-center justify-center gap-2 border-t border-zinc-100 bg-zinc-50 px-4 py-3 text-xs font-semibold text-micronix-600 transition hover:bg-micronix-50"
        >
            View all results for "{{ trim($q) }}"

            <flux:icon.arrow-right class="size-3.5" />
        </a>

    @else

        @include('partials.frontend.header.search.empty')

    @endif
</div>