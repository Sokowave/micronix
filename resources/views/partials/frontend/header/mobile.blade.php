{{-- resources/views/partials/frontend/header/mobile.blade.php --}}

<div class="lg:hidden">
    <div class="flex h-16 items-center gap-3 px-4">

        <button
            type="button"
            aria-label="Open menu"
            class="flex size-10 shrink-0 cursor-pointer items-center justify-center rounded-lg text-zinc-700 transition hover:bg-zinc-100"
        >
            <flux:icon.bars-3 class="size-6" />
        </button>

        <a
            href="{{ route('home') }}"
            wire:navigate
            class="min-w-0 flex-1"
            aria-label="Micronix home"
        >
            <span class="text-xl font-bold tracking-tight text-zinc-950">
                Micro<span class="text-micronix-500">nix</span>
            </span>
        </a>

        <a
            href="#"
            wire:navigate
            aria-label="Account"
            class="flex size-10 items-center justify-center rounded-lg text-zinc-700 transition hover:bg-zinc-100"
        >
            <flux:icon.user class="size-5" />
        </a>

        <a
            href="#"
            wire:navigate
            aria-label="Shopping cart"
            class="relative flex size-10 items-center justify-center rounded-lg text-zinc-700 transition hover:bg-zinc-100"
        >
            <flux:icon.shopping-cart class="size-5" />

            <span class="absolute right-0.5 top-0.5 flex size-4 items-center justify-center rounded-full bg-micronix-500 text-[9px] font-semibold text-white">
                0
            </span>
        </a>
    </div>

    <div class="px-4 pb-3">
        <form
            action="{{ route('search') }}"
            method="GET"
            role="search"
        >
            <label for="mobile-search" class="sr-only">
                Search products
            </label>

            <div class="relative">
                <flux:icon.magnifying-glass
                    class="pointer-events-none absolute left-3.5 top-1/2 size-5 -translate-y-1/2 text-zinc-400"
                />

                <input
                    id="mobile-search"
                    type="search"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search Micronix"
                    class="h-11 w-full rounded-xl border border-zinc-300 bg-zinc-50 pl-11 pr-4 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-micronix-500 focus:bg-white focus:ring-4 focus:ring-micronix-500/10"
                >
            </div>
        </form>
    </div>
</div>