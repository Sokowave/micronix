<div class="py-2">

    @if(auth()->user()->isBackoffice())

        <a
            href="{{ route('backoffice.dashboard') }}"
            wire:navigate
            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-micronix-700 transition hover:bg-micronix-50"
        >
            <flux:icon.squares-2x2 class="size-4" />

            Backoffice Dashboard
        </a>

        <hr class="my-2 border-zinc-100">

    @endif

    <a
        href="#"
        wire:navigate
        class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition hover:bg-zinc-50"
    >
        <flux:icon.user class="size-4" />

        My Account
    </a>

    <a
        href="#"
        wire:navigate
        class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition hover:bg-zinc-50"
    >
        <flux:icon.shopping-bag class="size-4" />

        My Orders
    </a>

    <a
        href="#"
        wire:navigate
        class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition hover:bg-zinc-50"
    >
        <flux:icon.heart class="size-4" />

        Wishlist
    </a>

    <a
        href="#"
        wire:navigate
        class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition hover:bg-zinc-50"
    >
        <flux:icon.map-pin class="size-4" />

        Addresses
    </a>

    <hr class="my-2 border-zinc-100">

    <form
        method="POST"
        action="{{ route('logout') }}"
    >
        @csrf

        <button
            type="submit"
            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-left text-sm text-red-600 transition hover:bg-red-50"
        >
            <flux:icon.arrow-left-start-on-rectangle class="size-4" />

            Sign Out
        </button>
    </form>

</div>