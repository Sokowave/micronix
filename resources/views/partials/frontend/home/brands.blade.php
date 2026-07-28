{{-- resources/views/partials/frontend/home/brands.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        {{-- Header --}}
        <div class="mb-3 flex items-center justify-between gap-4">
            <h2 class="text-base font-semibold text-zinc-900">
                Top Brands You Can Trust
            </h2>

            <a
                href=""
                wire:navigate
                class="
                    group inline-flex shrink-0 items-center gap-1
                    text-xs font-medium text-micronix-600
                    transition hover:text-micronix-700
                "
            >
                View All Brands

                <flux:icon.arrow-right
                    class="
                        size-3.5
                        transition-transform duration-200
                        group-hover:translate-x-0.5
                    "
                />
            </a>
        </div>

        {{-- Brands Carousel --}}
        <x-frontend.carousel
            type="default"
            :autoplay="false"
            :loop="false"
            :dots="false"
            :navigation="true"
        >
            @foreach ($brands as $brand)
                @php
                    $media = $brand->media;
                @endphp
                <div
                    wire:key="home-brand-{{ $brand->id }}"
                    class="shrink-0 basis-[135px] pr-2"
                >
                    <a
                        href="{{ route('products.index', [
                            'brand' => [$brand->slug],
                        ]) }}"
                        wire:navigate
                        aria-label="Shop {{ $brand->name }} products"
                        class="
                            group flex h-16 w-full
                            items-center justify-center
                            rounded-lg border border-zinc-200
                            bg-white px-5
                            transition duration-200
                            hover:border-micronix-200
                            hover:shadow-sm
                        "
                    >
                        <img
                            src="{{ $media?->url ?? 'https://placehold.co/160x60/ffffff/111111?text=' . urlencode($brand->name) }}"
                            alt="{{ $brand->name }}"
                            class="
                                max-h-8 max-w-[100px] object-contain
                                transition-transform duration-200
                                group-hover:scale-105
                            "
                            loading="lazy"
                            decoding="async"
                            width="160"
                            height="60"
                        >
                    </a>
                </div>
            @endforeach
        </x-frontend.carousel>

    </div>
</section>