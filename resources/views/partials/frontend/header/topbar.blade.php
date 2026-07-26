{{-- resources/views/partials/frontend/header/topbar.blade.php --}}

<div class="hidden border-b border-zinc-200 bg-zinc-50 lg:block">
    <div class="mx-auto flex h-9 max-w-7xl items-center justify-between px-4 text-xs text-zinc-500 xl:px-6">
        <div class="flex items-center gap-5">
            <a
                href="#"
                class="inline-flex items-center gap-1.5 transition hover:text-micronix-600"
            >
                <flux:icon.phone class="size-3.5" />
                Customer support
            </a>

            <span class="h-3 w-px bg-zinc-300"></span>

            <span class="inline-flex items-center gap-1.5">
                <flux:icon.truck class="size-3.5" />
                Fast delivery across Kenya
            </span>
        </div>

        <nav class="flex items-center gap-5" aria-label="Utility navigation">
            <a
                href="#"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Track Order
            </a>

            <a
                href="#"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Help Centre
            </a>
        </nav>
    </div>
</div>