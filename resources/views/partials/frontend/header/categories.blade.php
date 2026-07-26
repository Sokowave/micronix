{{-- resources/views/partials/frontend/header/categories.blade.php --}}

<nav
    class="relative hidden border-b border-zinc-200 bg-white lg:block"
    aria-label="Product categories"
>
    <div class="mx-auto flex h-12 max-w-7xl items-center px-4 xl:px-6">

        {{-- All Categories + Mega Menu --}}
        <div class="group/mega relative h-full shrink-0">

            <button
                type="button"
                class="mr-6 inline-flex h-full items-center cursor-pointer"
                aria-label="Browse all categories"
            >
                <span
                    class="inline-flex h-9 items-center gap-2 rounded-lg bg-micronix-500 px-4 text-sm font-medium text-white transition group-hover/mega:bg-micronix-600"
                >
                    <flux:icon.squares-2x2 class="size-4" />

                    <span>All Categories</span>

                    <flux:icon.chevron-down
                        class="size-3.5 transition-transform duration-200 group-hover/mega:rotate-180"
                    />
                </span>
            </button>

            <x-frontend.mega-menu />

        </div>

        {{-- Main Categories --}}
        <div
            class="
                flex min-w-0 flex-1 items-center
                gap-7 overflow-x-auto
                whitespace-nowrap
                text-sm font-medium text-zinc-700
                [scrollbar-width:none]
                [&::-webkit-scrollbar]:hidden
            "
        >
            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Computers
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Computer Components
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Monitors
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Printers & Scanners
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Networking
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Computer Accessories
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Cameras
            </a>

            <a
                href="#"
                wire:navigate
                class="shrink-0 transition hover:text-micronix-600"
            >
                Power & Backup
            </a>
        </div>

        {{-- Deals --}}
        <a
            href="#"
            wire:navigate
            class="ml-6 flex shrink-0 items-center gap-1.5 text-sm font-semibold text-micronix-600 transition hover:text-micronix-700"
        >
            <flux:icon.bolt class="size-4" />

            <span>Deals</span>
        </a>

    </div>
</nav>