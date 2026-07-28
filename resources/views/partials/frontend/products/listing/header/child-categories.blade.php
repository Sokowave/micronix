

        @if ($category && $category->children->isNotEmpty())
            <div
                class="
                    -mx-4 mt-5 flex gap-2
                    overflow-x-auto px-4
                    [scrollbar-width:none]
                    [&::-webkit-scrollbar]:hidden
                    sm:mx-0 sm:px-0
                "
            >
                @foreach ($category->children as $child)
                    <a
                        href="{{ route('categories.show', $child) }}"
                        wire:navigate
                        class="
                            group inline-flex h-9 shrink-0
                            items-center gap-2
                            rounded-lg
                            border border-zinc-200
                            bg-white px-3
                            text-xs font-medium
                            text-zinc-700
                            transition
                            hover:border-micronix-200
                            hover:bg-micronix-50
                            hover:text-micronix-600
                        "
                    >
                        @if ($child->icon)
                            <flux:icon
                                :name="$child->icon"
                                class="
                                    size-4 text-zinc-400
                                    transition
                                    group-hover:text-micronix-500
                                "
                            />
                        @else
                            <flux:icon.folder
                                class="
                                    size-4 text-zinc-400
                                    transition
                                    group-hover:text-micronix-500
                                "
                            />
                        @endif

                        <span>{{ $child->name }}</span>

                        <flux:icon.chevron-right
                            class="
                                size-3.5 text-zinc-300
                                transition
                                group-hover:translate-x-0.5
                                group-hover:text-micronix-500
                            "
                        />
                    </a>
                @endforeach
            </div>
        @endif