@if ($suggestions['products']->isNotEmpty())
    @php
        $offset =
            $suggestions['tags']->count() +
            $suggestions['categories']->count();
    @endphp

    <div class="py-2">
        <p class="px-4 py-1 text-[10px] font-semibold uppercase tracking-wider text-zinc-400">
            Products
        </p>

        @foreach ($suggestions['products'] as $product)
            @php
                $index = $offset + $loop->index;

                $imageUrl = \App\Support\MediaUrl::get(
                    $product->details()->primaryMedia()
                );
            @endphp

            <a
                href="{{ route('products.show', $product->slug) }}"
                wire:navigate
                wire:key="search-product-{{ $product->public_id }}"
                data-suggestion-index="{{ $index }}"
                role="option"
                @class([
                    'group flex items-center gap-3 px-4 py-2.5 transition',
                    'bg-micronix-50' => $activeIndex === $index,
                    'hover:bg-zinc-50' => $activeIndex !== $index,
                ])
            >
                <div class="flex size-11 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-zinc-50">
                    @if ($imageUrl)
                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $product->name }}"
                            class="h-full w-full object-contain"
                        >
                    @else
                        <flux:icon.photo class="size-5 text-zinc-300" />
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <p
                        @class([
                            'truncate text-sm font-medium transition',
                            'text-micronix-600' => $activeIndex === $index,
                            'text-zinc-800 group-hover:text-micronix-600' => $activeIndex !== $index,
                        ])
                    >
                        {{ $product->name }}
                    </p>

                    @if ($product->category)
                        <p class="mt-0.5 truncate text-xs text-zinc-500">
                            {{ $product->category->name }}
                        </p>
                    @endif
                </div>

                <flux:icon.chevron-right
                    class="size-4 shrink-0 text-zinc-300 transition group-hover:translate-x-0.5 group-hover:text-micronix-500"
                />
            </a>
        @endforeach
    </div>
@endif