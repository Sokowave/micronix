{{-- resources/views/partials/frontend/header/actions.blade.php --}}

<div class="flex shrink-0 items-center gap-1">

    <a
        href="#"
        wire:navigate
        class="group flex h-12 items-center gap-2 rounded-xl px-3 transition hover:bg-zinc-50"
    >
        <div class="relative">
            <flux:icon.heart class="size-5 text-zinc-700 transition group-hover:text-micronix-600" />
        </div>

        <div class="hidden xl:block">
            <span class="block text-[11px] leading-none text-zinc-400">
                Saved
            </span>

            <span class="mt-1 block text-sm font-medium leading-none text-zinc-800">
                Wishlist
            </span>
        </div>
    </a>

    <a
        href="#"
        wire:navigate
        class="group flex h-12 items-center gap-2 rounded-xl px-3 transition hover:bg-zinc-50"
    >
        <flux:icon.user class="size-5 text-zinc-700 transition group-hover:text-micronix-600" />

        <div class="hidden xl:block">
            <span class="block text-[11px] leading-none text-zinc-400">
                {{ auth()->check() ? 'Welcome' : 'Sign in' }}
            </span>

            <span class="mt-1 block max-w-24 truncate text-sm font-medium leading-none text-zinc-800">
                {{ auth()->user()?->name ?? 'Account' }}
            </span>
        </div>
    </a>

    <a
        href="#"
        wire:navigate
        class="group flex h-12 items-center gap-2 rounded-xl px-3 transition hover:bg-zinc-50"
    >
        <div class="relative">
            <flux:icon.shopping-cart class="size-5 text-zinc-700 transition group-hover:text-micronix-600" />

            <span class="absolute -right-2.5 -top-2.5 flex min-w-4.5 h-4.5 items-center justify-center rounded-full bg-micronix-500 px-1 text-[10px] font-semibold text-white">
                0
            </span>
        </div>

        <div class="hidden xl:block">
            <span class="block text-[11px] leading-none text-zinc-400">
                Your cart
            </span>

            <span class="mt-1 block text-sm font-medium leading-none text-zinc-800">
                KSh 0
            </span>
        </div>
    </a>

</div>