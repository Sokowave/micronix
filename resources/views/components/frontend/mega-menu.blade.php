{{-- resources/views/components/frontend/mega-menu.blade.php --}}

<div
    data-mega-menu
    class="
        invisible absolute left-0 top-full z-50
        translate-y-1 opacity-0
        transition-all duration-200 ease-out
        group-hover/mega:visible
        group-hover/mega:translate-y-0
        group-hover/mega:opacity-100
    "
>
    <div
        class="
            flex min-h-[420px]
            overflow-hidden rounded-lg
            border border-zinc-200
            bg-white shadow-xl
        "
    >
        {{-- ========================================================= --}}
        {{-- Level 1: Parent Categories                                --}}
        {{-- ========================================================= --}}

        <aside class="w-64 shrink-0 border-r border-zinc-200 bg-white">
            <ul class="p-2">
                @foreach ($categories as $index => $category)
                    <li>
                        <a
                            href="{{ route('categories.show', $category['slug']) }}"
                            wire:navigate
                            data-mega-menu-trigger="{{ $index }}"
                            class="
                                group/item
                                flex items-center rounded-md
                                px-3 py-2
                                text-sm
                                transition-colors duration-200

                                {{ $index === 0
                                    ? 'bg-micronix-50 text-micronix-600'
                                    : 'text-zinc-700 hover:bg-micronix-50 hover:text-micronix-600'
                                }}
                            "
                        >
                            {{-- Icon --}}
                            @if (! empty($category['icon']))
                                <flux:icon
                                    :name="$category['icon']"
                                    data-mega-menu-icon
                                    class="
                                        mr-3 size-4 shrink-0
                                        transition-colors duration-200

                                        {{ $index === 0
                                            ? 'text-micronix-600'
                                            : 'text-zinc-400 group-hover/item:text-micronix-500'
                                        }}
                                    "
                                />
                            @else
                                <flux:icon.folder
                                    data-mega-menu-icon
                                    class="
                                        mr-3 size-4 shrink-0
                                        transition-colors duration-200

                                        {{ $index === 0
                                            ? 'text-micronix-600'
                                            : 'text-zinc-400 group-hover/item:text-micronix-500'
                                        }}
                                    "
                                />
                            @endif

                            <span class="min-w-0 flex-1 truncate">
                                {{ $category['name'] }}
                            </span>

                            @if (! empty($category['children']))
                                <flux:icon.chevron-right
                                    data-mega-menu-arrow
                                    class="
                                        ml-auto size-4 shrink-0
                                        transition-all duration-200

                                        {{ $index === 0
                                            ? 'translate-x-1 text-micronix-600'
                                            : 'text-zinc-400 group-hover/item:translate-x-1 group-hover/item:text-micronix-500'
                                        }}
                                    "
                                />
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        {{-- ========================================================= --}}
        {{-- Right Mega Menu                                           --}}
        {{-- ========================================================= --}}

        <section
            class="
                relative
                min-h-[420px]
                w-[992px]
            "
        >
            @foreach ($categories as $index => $category)
                <div
                    data-mega-menu-panel="{{ $index }}"
                    @class([
                        'absolute inset-0 h-full w-full overflow-y-auto bg-white p-6',
                        'opacity-100' => $index === 0,
                        'pointer-events-none invisible opacity-0' => $index !== 0,
                    ])
                >
                    {{-- ============================================= --}}
                    {{-- Level 2                                      --}}
                    {{-- ============================================= --}}

                    @if (! empty($category['children']))
                        <div class="grid grid-cols-4 gap-8">
                            @foreach ($category['children'] as $child)
                                <section class="space-y-3">

                                    {{-- Level 2 Category --}}
                                    <a
                                        href="{{ route('categories.show', $child['slug']) }}"
                                        wire:navigate
                                        class="
                                            block
                                            border-b border-micronix-100
                                            pb-2
                                            text-sm font-semibold
                                            text-micronix-600
                                            transition-colors
                                            hover:text-micronix-700
                                        "
                                    >
                                        {{ $child['name'] }}
                                    </a>

                                    {{-- ================================= --}}
                                    {{-- Level 3                           --}}
                                    {{-- ================================= --}}

                                    @if (! empty($child['children']))
                                        <ul class="space-y-2">
                                            @foreach ($child['children'] as $grandchild)
                                                <li>
                                                    <a
                                                        href="{{ route('categories.show', $grandchild['slug']) }}"
                                                        wire:navigate
                                                        class="
                                                            block
                                                            text-sm
                                                            text-zinc-600
                                                            transition-colors
                                                            hover:text-micronix-600
                                                        "
                                                    >
                                                        {{ $grandchild['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                </section>
                            @endforeach
                        </div>
                    @else
                        <div class="py-10 text-sm text-zinc-500">
                            No subcategories available.
                        </div>
                    @endif
                </div>
            @endforeach
        </section>
    </div>
</div>
