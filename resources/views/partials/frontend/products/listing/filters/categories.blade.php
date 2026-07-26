{{-- resources/views/partials/frontend/products/listing/filters/categories.blade.php --}}

<div class="pb-5">
    <div class="mb-3 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-zinc-900">
            Categories
        </h3>
    </div>

    <nav aria-label="Product categories">
        <ul class="space-y-0.5">

            {{-- Back --}}
            @if ($category)
                <li>
                    <a
                        href="{{ $category->parent
                            ? route('categories.show', $category->parent)
                            : route('products.index') }}"
                        wire:navigate
                        class="
                            group flex items-center gap-2
                            rounded-lg px-2.5 py-2
                            text-sm font-medium text-zinc-600
                            transition
                            hover:bg-micronix-50
                            hover:text-micronix-600
                        "
                    >
                        <flux:icon.arrow-uturn-left
                            class="
                                size-4 shrink-0
                                text-zinc-400
                                transition
                                group-hover:-translate-x-0.5
                                group-hover:text-micronix-500
                            "
                        />

                        <span class="truncate">
                            {{ $category->parent?->name ?? 'All Categories' }}
                        </span>
                    </a>
                </li>
            @endif

            {{-- Current Category --}}
            @if ($category)
                <li>
                    <div
                        class="
                            flex items-center gap-2.5
                            rounded-lg
                            bg-micronix-50
                            px-2.5 py-2
                            text-sm font-medium
                            text-micronix-600
                        "
                    >
                        @if ($category->icon)
                            <flux:icon
                                :name="$category->icon"
                                class="size-4 shrink-0 text-micronix-500"
                            />
                        @else
                            <flux:icon.folder
                                class="size-4 shrink-0 text-micronix-500"
                            />
                        @endif

                        <span class="truncate">
                            {{ $category->name }}
                        </span>
                    </div>
                </li>
            @endif

            {{-- Immediate Children --}}
            @foreach ($categories as $item)
                <li>
                    <a
                        href="{{ route('categories.show', $item) }}"
                        wire:navigate
                        class="
                            group flex items-center justify-between
                            gap-3 rounded-lg px-2.5 py-2
                            text-sm text-zinc-600
                            transition
                            hover:bg-micronix-50
                            hover:text-micronix-600
                        "
                    >
                        <span class="flex min-w-0 items-center gap-2.5">
                            @if ($item->icon)
                                <flux:icon
                                    :name="$item->icon"
                                    class="
                                        size-4 shrink-0
                                        text-zinc-400
                                        transition
                                        group-hover:text-micronix-500
                                    "
                                />
                            @else
                                <flux:icon.folder
                                    class="
                                        size-4 shrink-0
                                        text-zinc-400
                                        transition
                                        group-hover:text-micronix-500
                                    "
                                />
                            @endif

                            <span class="truncate">
                                {{ $item->name }}
                            </span>
                        </span>

                        <flux:icon.chevron-right
                            class="
                                size-3.5 shrink-0
                                text-zinc-300
                                transition
                                group-hover:translate-x-0.5
                                group-hover:text-micronix-500
                            "
                        />
                    </a>
                </li>
            @endforeach

        </ul>
    </nav>
</div>