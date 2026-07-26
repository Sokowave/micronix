{{-- resources/views/partials/frontend/products/show/product-info/meta.blade.php --}}

<div
    class="
        mt-3 flex flex-wrap
        items-center gap-x-4 gap-y-2
        text-xs
    "
>
    {{-- Reviews --}}
    <a
        href="#product-reviews"
        class="
            flex items-center gap-1.5
            transition hover:text-micronix-600
        "
    >
        <span class="font-semibold text-zinc-800">
            4.8
        </span>

        <span
            class="flex items-center gap-0.5 text-amber-400"
            aria-label="4.8 out of 5 stars"
        >
            <flux:icon.star variant="solid" class="size-3.5" />
            <flux:icon.star variant="solid" class="size-3.5" />
            <flux:icon.star variant="solid" class="size-3.5" />
            <flux:icon.star variant="solid" class="size-3.5" />
            <flux:icon.star variant="solid" class="size-3.5" />
        </span>

        <span class="text-zinc-500">
            24 reviews
        </span>
    </a>

    <span
        class="hidden h-4 w-px bg-zinc-200 sm:block"
        aria-hidden="true"
    ></span>

    {{-- SKU --}}
    <span class="text-zinc-500">
        SKU:

        <span class="font-medium text-zinc-700">
            {{ $product->sku }}
        </span>
    </span>
</div>