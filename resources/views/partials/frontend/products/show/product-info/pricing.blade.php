{{-- resources/views/partials/frontend/products/show/product-info/pricing.blade.php --}}
@include('partials/frontend/products/show/deal-countdown')

<div class="mt-5 border-y border-zinc-100 py-4">

    <div class="flex flex-wrap items-end gap-x-3 gap-y-1">
        <span
            class="
                text-2xl font-bold tracking-tight
                text-micronix-600                
            "
        >
            KES {{ number_format($details->currentPrice()) }}
        </span>

        @if ($details->hasDiscount())
            <span class="pb-0.5 text-sm text-zinc-400 line-through">
                KES {{ number_format((float) $product->price) }}
            </span>

            <span
                class="
                    mb-0.5 inline-flex
                    rounded-md bg-red-50
                    px-2 py-1
                    text-[10px] font-bold text-red-600
                "
            >
                SAVE {{ $details->discountPercentage() }}%
            </span>
        @endif
    </div>

    <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1">
        <span class="text-[11px] text-zinc-500">
            VAT Exclusive
        </span>

        @if ($details->hasDiscount())
            <span
                class="hidden size-1 rounded-full bg-zinc-300 sm:block"
                aria-hidden="true"
            ></span>

            <span class="text-[11px] font-medium text-emerald-600">
                You save KES {{ number_format($details->discountAmount()) }}
            </span>
        @endif
    </div>

</div>