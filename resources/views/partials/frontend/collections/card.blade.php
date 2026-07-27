{{-- resources/views/partials/frontend/collections/card.blade.php --}}

<a
    href="{{ route('collections.show', $collection->slug) }}"
    wire:navigate
    class="
        group flex min-h-24
        items-center gap-3 overflow-hidden
        rounded-xl border border-zinc-200
        bg-gradient-to-br from-zinc-50 to-white
        px-4 py-3
        transition duration-200
        hover:border-micronix-200 hover:shadow-sm
    "
>
    {{-- Image --}}
    <div class="flex size-16 shrink-0 items-center justify-center">
        <img
            src="{{ $collection->media?->url ?? 'https://placehold.co/160x160' }}"
            alt="{{ $collection->name }}"
            loading="lazy"
            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
        >
    </div>

    {{-- Content --}}
    <div class="min-w-0">
        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
            {{ $collection->name }}
        </h3>

        @if ($collection->description)
            <p class="mt-1 line-clamp-2 text-[11px] leading-4 text-zinc-500">
                {{ $collection->description }}
            </p>
        @endif
    </div>
</a>