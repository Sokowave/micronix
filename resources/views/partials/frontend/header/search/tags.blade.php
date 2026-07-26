@if ($suggestions['tags']->isNotEmpty())
    <div class="border-b border-zinc-100 py-2">
        <p class="px-4 py-1 text-[10px] font-semibold uppercase tracking-wider text-zinc-400">
            Tags
        </p>

        @foreach ($suggestions['tags'] as $tag)
            @php
                $index = $loop->index;
            @endphp

            <a
                href="{{ route('search', ['q' => $tag->name]) }}"
                wire:navigate
                wire:key="search-tag-{{ $tag->public_id }}"
                data-suggestion-index="{{ $index }}"
                role="option"
                @class([
                    'group flex items-center gap-3 px-4 py-2 text-sm transition',
                    'bg-micronix-50 text-micronix-600' => $activeIndex === $index,
                    'text-zinc-700 hover:bg-zinc-50 hover:text-micronix-600' => $activeIndex !== $index,
                ])
            >
                <flux:icon.tag
                    class="size-4 shrink-0 text-zinc-400 transition group-hover:text-micronix-500"
                />

                <span class="min-w-0 flex-1 truncate">
                    {{ $tag->name }}
                </span>

                <flux:icon.arrow-up-right
                    class="size-4 shrink-0 text-zinc-300 transition group-hover:text-micronix-500"
                />
            </a>
        @endforeach
    </div>
@endif