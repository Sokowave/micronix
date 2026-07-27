{{-- resources/views/partials/frontend/home/use-cases.blade.php --}}

@if ($collections->isNotEmpty())
    <section class="py-4">
        <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

            {{-- Header --}}
            <div class="mb-3 flex items-center justify-between gap-4">
                <h2 class="text-base font-semibold text-zinc-900">
                    Shop by Use Case
                </h2>

                <a
                    href="{{ route('collections.index') }}"
                    wire:navigate
                    class="group inline-flex shrink-0 items-center gap-1 text-xs font-medium text-micronix-600 transition hover:text-micronix-700"
                >
                    View All Use Cases

                    <flux:icon.arrow-right
                        class="size-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                    />
                </a>
            </div>

            {{-- Carousel --}}
            <x-frontend.carousel
                type="default"
                :autoplay="false"
                :loop="false"
                :dots="false"
                :navigation="true"
            >
                @foreach ($collections as $collection)
                    <div
                        wire:key="use-case-{{ $collection->public_id }}"
                        class="shrink-0 basis-[260px] pr-3"
                    >
                        @include('partials.frontend.collections.card', [
                            'collection' => $collection,
                        ])
                    </div>
                @endforeach
            </x-frontend.carousel>

        </div>
    </section>
@endif