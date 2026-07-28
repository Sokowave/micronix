{{-- resources/views/partials/frontend/products/show/gallery.blade.php --}}

@php
    use App\Support\MediaUrl;

    $galleryImages = $product->media
        ->map(fn ($media) => [
            'src' => MediaUrl::get($media),
            'alt' => $product->name,
        ])
        ->filter(fn ($image) => filled($image['src']))
        ->values();

    $galleryCount = $galleryImages->count();
@endphp

<div data-product-gallery class="w-full">
    <div class="flex flex-col gap-3 lg:grid lg:grid-cols-[72px_minmax(0,1fr)]">

        {{-- Desktop thumbnails --}}
        @if ($galleryCount > 1)
        <div class="relative hidden min-h-0 lg:block">
            <div
                data-gallery-thumbs-viewport
                class="absolute inset-0 overflow-hidden"
            >
                <div class="flex h-full flex-col">
                    @foreach ($galleryImages as $index => $image)
                        <div class="min-h-0 flex-[0_0_80px] px-0.5 pb-2">
                            <button
                                type="button"
                                data-gallery-thumbnail="{{ $index }}"
                                aria-label="View product image {{ $index + 1 }}"
                                @class([
                                    'aspect-square w-full cursor-pointer overflow-hidden rounded-lg border bg-white p-1.5 transition',
                                    'border-micronix-500 ring-1 ring-micronix-500' => $index === 0,
                                    'border-zinc-200 hover:border-micronix-300' => $index !== 0,
                                ])
                            >
                                <img
                                    src="{{ $image['src'] }}"
                                    alt="{{ $image['alt'] }}"
                                    loading="{{ $index ? 'lazy' : 'eager' }}"
                                    draggable="false"
                                    class="h-full w-full select-none object-contain"
                                >
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Main gallery --}}
        <div @class(['min-w-0', 'lg:col-span-2' => $galleryCount <= 1])>
            <div class="group/gallery relative aspect-square overflow-hidden rounded-xl border border-zinc-200 bg-white">

                {{-- Images --}}
                @if ($galleryCount)
                    <div
                        data-gallery-viewport
                        class="h-full overflow-hidden"
                    >
                        <div class="flex h-full touch-pan-y">
                            @foreach ($galleryImages as $index => $image)
                                <div class="h-full min-w-0 flex-[0_0_100%]">
                                    <button
                                        type="button"
                                        data-gallery-image="{{ $index }}"
                                        aria-label="Open {{ $image['alt'] }}"
                                        class="flex h-full w-full cursor-zoom-in items-center justify-center"
                                    >
                                        <img
                                            src="{{ $image['src'] }}"
                                            alt="{{ $image['alt'] }}"
                                            loading="{{ $index ? 'lazy' : 'eager' }}"
                                            draggable="false"
                                            class="h-full w-full select-none object-contain"
                                        >
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="flex h-full items-center justify-center">
                        <flux:icon.photo class="size-16 text-zinc-200" />
                    </div>
                @endif

                {{-- Badges --}}
                <div class="pointer-events-none absolute left-3 top-3 z-10 flex flex-col items-start gap-1.5">
                    @if ($product->details()->hasDiscount())
                        <span class="rounded-md bg-micronix-600 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                            -{{ $product->details()->discountPercentage() }}%
                        </span>
                    @endif

                    @if ($product->condition === 'new')
                        <span class="rounded-md bg-emerald-500 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-white">
                            New
                        </span>
                    @endif
                </div>

                {{-- Wishlist --}}
                <button
                    type="button"
                    aria-label="Add {{ $product->name }} to wishlist"
                    class="absolute right-3 top-3 z-20 flex size-10 cursor-pointer items-center justify-center rounded-full border border-zinc-200 bg-white/95 text-zinc-500 shadow-sm transition hover:border-micronix-200 hover:bg-micronix-50 hover:text-micronix-600"
                >
                    <flux:icon.heart class="size-5" />
                </button>

                @if ($galleryCount > 1)
                    {{-- Previous --}}
                    <button
                        type="button"
                        data-gallery-previous
                        aria-label="Previous product image"
                        class="absolute left-3 top-1/2 z-20 flex size-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border border-zinc-200 bg-white/95 text-zinc-600 opacity-0 shadow-sm transition hover:border-micronix-200 hover:text-micronix-600 group-hover/gallery:opacity-100 disabled:pointer-events-none disabled:opacity-30 max-lg:opacity-100"
                    >
                        <flux:icon.chevron-left class="size-4" />
                    </button>

                    {{-- Next --}}
                    <button
                        type="button"
                        data-gallery-next
                        aria-label="Next product image"
                        class="absolute right-3 top-1/2 z-20 flex size-9 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full border border-zinc-200 bg-white/95 text-zinc-600 opacity-0 shadow-sm transition hover:border-micronix-200 hover:text-micronix-600 group-hover/gallery:opacity-100 disabled:pointer-events-none disabled:opacity-30 max-lg:opacity-100"
                    >
                        <flux:icon.chevron-right class="size-4" />
                    </button>

                    {{-- Mobile counter --}}
                    <div class="absolute bottom-3 right-3 z-10 rounded-full bg-zinc-900/70 px-2.5 py-1 text-[10px] font-medium text-white backdrop-blur-sm lg:hidden">
                        <span data-gallery-current>1</span>
                        <span class="text-white/60">/</span>
                        <span>{{ $galleryCount }}</span>
                    </div>
                @endif

                {{-- Zoom hint --}}
                @if ($galleryCount)
                    <div class="pointer-events-none absolute bottom-3 left-1/2 z-10 hidden -translate-x-1/2 lg:block">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-white/90 px-3 py-1.5 text-[10px] font-medium text-zinc-500 opacity-0 shadow-sm transition-opacity group-hover/gallery:opacity-100">
                            <flux:icon.magnifying-glass-plus class="size-3.5" />
                            Click to zoom
                        </span>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>