{{-- resources/views/partials/frontend/products/listing/header.blade.php --}}

<section class="border-b border-zinc-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-5 xl:px-6">

        @include('partials.frontend.products.listing.breadcrumb')

        {{-- Heading --}}
        <div>
            <h1
                class="
                    text-2xl font-bold tracking-tight
                    text-zinc-950
                    sm:text-3xl
                "
            >
                {{ $category?->name ?? 'All Products' }}
            </h1>

            <p
                class="
                    mt-1.5 max-w-3xl
                    text-sm leading-6
                    text-zinc-500
                "
            >
                {{ $category?->description ?: 'Shop computers, components, accessories, networking, cameras and more from leading technology brands.' }}
            </p>
        </div>

        {{-- Child Categories --}}
        @if ($category?->relationLoaded('children') && $category->children->isNotEmpty())
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

    </div>
</section>