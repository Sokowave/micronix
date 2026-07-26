{{-- resources/views/partials/frontend/home/categories.blade.php --}}

@if ($categories->isNotEmpty())
    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            {{-- Header --}}
            <div class="mb-4 flex items-center justify-between gap-4">
                <h2 class="text-lg font-semibold text-zinc-900">
                    Shop by Category
                </h2>

                <a
                    href="#"
                    wire:navigate
                    class="
                        group inline-flex shrink-0 items-center gap-1
                        text-sm font-medium text-micronix-600
                        transition hover:text-micronix-700
                    "
                >
                    View All Categories

                    <flux:icon.arrow-right
                        class="
                            size-4
                            transition-transform duration-200
                            group-hover:translate-x-0.5
                        "
                    />
                </a>
            </div>

            {{-- Categories --}}
            <x-frontend.carousel
                type="default"
                :autoplay="false"
                :loop="true"
                :dots="false"
                :navigation="true"
            >
                @foreach ($categories as $category)
                    <div
                        wire:key="home-category-{{ $category->public_id }}"
                        class="
                            min-w-0 shrink-0
                            basis-[140px] pr-3
                            sm:basis-[150px]
                            lg:basis-[160px]
                        "
                    >
                        <a
                            href="{{ route('categories.show', $category) }}"
                            wire:navigate
                            class="
                                group flex h-full w-full
                                flex-col items-center justify-center
                                rounded-xl border border-zinc-200
                                bg-white px-3 py-4 text-center
                                transition duration-200
                                hover:border-micronix-200
                                hover:shadow-sm
                            "
                        >
                            {{-- Image --}}
                            <div
                                class="
                                    flex size-20 shrink-0
                                    items-center justify-center
                                    overflow-hidden rounded-lg
                                    bg-zinc-50
                                "
                            >
                                @if ($category->media?->url)
                                    <img
                                        src="{{ $category->media->url }}"
                                        alt="{{ $category->name }}"
                                        width="160"
                                        height="160"
                                        loading="lazy"
                                        class="
                                            h-full w-full object-contain p-2
                                            transition-transform duration-300
                                            group-hover:scale-105
                                        "
                                    >
                                @else
                                    <img
                                        src="https://placehold.co/160x160"
                                        alt="{{ $category->name }}"
                                        width="160"
                                        height="160"
                                        loading="lazy"
                                        class="
                                            h-full w-full object-contain p-2
                                            transition-transform duration-300
                                            group-hover:scale-105
                                        "
                                    >
                                @endif
                            </div>

                            {{-- Name --}}
                            <span
                                class="
                                    mt-3 line-clamp-2
                                    text-sm font-medium leading-tight
                                    text-zinc-800
                                    transition
                                    group-hover:text-micronix-600
                                "
                            >
                                {{ $category->name }}
                            </span>
                        </a>
                    </div>
                @endforeach
            </x-frontend.carousel>

        </div>
    </section>
@endif