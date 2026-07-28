{{-- resources/views/partials/frontend/products/listing/toolbar/view-switcher.blade.php --}}

<div
    class="
        hidden items-center
        rounded-lg border border-zinc-200
        bg-white p-0.5
        sm:flex
    "
>
    {{-- Grid --}}
    <button
        type="button"
        aria-label="Grid view"
        title="Grid view"
        class="
            flex size-8 cursor-pointer
            items-center justify-center
            rounded-md
            bg-micronix-50
            text-micronix-600
            transition
            hover:bg-micronix-100
        "
    >
        <flux:icon.squares-2x2 class="size-4" />
    </button>

    {{-- List --}}
    <button
        type="button"
        aria-label="List view"
        title="List view"
        class="
            flex size-8 cursor-pointer
            items-center justify-center
            rounded-md
            text-zinc-400
            transition
            hover:bg-zinc-50
            hover:text-zinc-700
        "
    >
        <flux:icon.list-bullet class="size-4" />
    </button>
</div>