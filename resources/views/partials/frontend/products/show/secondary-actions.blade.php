{{-- resources/views/partials/frontend/products/show/secondary-actions.blade.php --}}

<div
    class="
        flex min-w-0 items-center
        divide-x divide-zinc-200
        pt-1
    "
>
    {{-- Wishlist --}}
    <button
        type="button"
        class="
            group inline-flex min-w-0 flex-1
            cursor-pointer items-center justify-center
            gap-1.5 px-2 py-2
            text-xs font-medium text-zinc-500
            transition
            hover:text-micronix-600
        "
    >
        <flux:icon.heart
            class="
                size-4 shrink-0 transition
                group-hover:scale-110
            "
        />

        <span class="truncate">
            Wishlist
        </span>
    </button>

    {{-- Share --}}
    <button
        type="button"
        class="
            group inline-flex min-w-0 flex-1
            cursor-pointer items-center justify-center
            gap-1.5 px-2 py-2
            text-xs font-medium text-zinc-500
            transition
            hover:text-micronix-600
        "
    >
        <flux:icon.share class="size-4 shrink-0" />

        <span class="truncate">
            Share
        </span>
    </button>
</div>