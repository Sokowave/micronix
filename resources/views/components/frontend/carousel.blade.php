{{-- resources/views/components/frontend/carousel.blade.php --}}

@props([
    'type' => 'default',
    'axis' => 'x',
    'autoplay' => false,
    'loop' => false,
    'dots' => false,
    'navigation' => false,
    'delay' => 5000,
])

<div
    {{ $attributes->class('relative h-full min-w-0') }}
    data-embla
    data-embla-type="{{ $type }}"
    data-embla-axis="{{ $axis }}"
    data-embla-loop="{{ $loop ? 'true' : 'false' }}"
    data-embla-autoplay="{{ $autoplay ? 'true' : 'false' }}"
    data-embla-delay="{{ $delay }}"
>
    {{-- Viewport --}}
    <div
        data-embla-viewport
        class="h-full overflow-hidden"
    >
        <div
            @class([
                'flex h-full',
                'touch-pan-y' => $axis === 'x',
                'flex-col touch-pan-x' => $axis === 'y',
            ])
        >
            {{ $slot }}
        </div>
    </div>

    {{-- Navigation --}}
    @if ($navigation)
        <button
            type="button"
            data-embla-prev
            aria-label="Previous slide"
            @class([
                '
                    absolute z-20
                    flex size-9 cursor-pointer
                    items-center justify-center
                    rounded-full border border-zinc-200/80
                    bg-white/90 text-zinc-700
                    shadow-sm backdrop-blur-sm
                    transition
                    hover:border-zinc-300
                    hover:bg-white
                    hover:text-micronix-600
                    disabled:pointer-events-none
                    disabled:opacity-30
                ',
                'left-3 top-1/2 -translate-y-1/2' => $axis === 'x',
                'left-1/2 top-2 -translate-x-1/2' => $axis === 'y',
            ])
        >
            @if ($axis === 'y')
                <flux:icon.chevron-up class="size-4" />
            @else
                <flux:icon.chevron-left class="size-4" />
            @endif
        </button>

        <button
            type="button"
            data-embla-next
            aria-label="Next slide"
            @class([
                '
                    absolute z-20
                    flex size-9 cursor-pointer
                    items-center justify-center
                    rounded-full border border-zinc-200/80
                    bg-white/90 text-zinc-700
                    shadow-sm backdrop-blur-sm
                    transition
                    hover:border-zinc-300
                    hover:bg-white
                    hover:text-micronix-600
                    disabled:pointer-events-none
                    disabled:opacity-30
                ',
                'right-3 top-1/2 -translate-y-1/2' => $axis === 'x',
                'bottom-2 left-1/2 -translate-x-1/2' => $axis === 'y',
            ])
        >
            @if ($axis === 'y')
                <flux:icon.chevron-down class="size-4" />
            @else
                <flux:icon.chevron-right class="size-4" />
            @endif
        </button>
    @endif

    {{-- Dots --}}
    @if ($dots)
        <div
            data-embla-dots
            aria-label="Carousel navigation"
            class="
                absolute bottom-3 left-1/2 z-20
                flex -translate-x-1/2
                items-center justify-center gap-1.5
                rounded-full bg-black/15
                px-2 py-1.5 backdrop-blur-sm
            "
        ></div>
    @endif
</div>