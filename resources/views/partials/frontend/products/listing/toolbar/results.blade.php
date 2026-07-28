<div class="min-w-0">
    <p class="text-xs text-zinc-500 sm:text-sm">
        <span class="font-semibold text-zinc-900">
            {{ number_format($products->total()) }}
        </span>

        <span>
            {{ Str::plural('product', $products->total()) }}
        </span>
    </p>
</div>