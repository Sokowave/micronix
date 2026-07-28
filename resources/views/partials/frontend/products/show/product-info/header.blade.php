{{-- resources/views/partials/frontend/products/show/product-info/header.blade.php --}}

<div class="flex flex-wrap items-center justify-between gap-3">
    @if ($product->brand)
        <a
            href="{{ $details->brandUrl() }}"
            wire:navigate
            class="
                text-xs font-semibold uppercase tracking-wide
                text-micronix-600 transition
                hover:text-micronix-700
            "
        >
            {{ $product->brand->name }}
        </a>
    @endif

    @if ($product->details()->inStock())
        <div
            class="
                inline-flex items-center gap-1.5
                rounded-full bg-emerald-50
                px-2.5 py-1
                text-[11px] font-semibold text-emerald-700
            "
        >
            <span class="size-1.5 rounded-full bg-emerald-500"></span>

            In Stock
        </div>
    @else
        <div
            class="
                inline-flex items-center gap-1.5
                rounded-full bg-red-50
                px-2.5 py-1
                text-[11px] font-semibold text-red-700
            "
        >
            <span class="size-1.5 rounded-full bg-red-500"></span>

            Out of Stock
        </div>
    @endif
</div>

<h1
    class="
        mt-3 text-xl font-bold
        leading-tight tracking-tight
        text-zinc-950
        sm:text-2xl
        lg:text-[24px]
    "
>
    {{ $product->name }}
</h1>