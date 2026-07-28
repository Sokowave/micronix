<div class="space-y-4 p-4">

    <div>

        <h3 class="font-semibold text-zinc-900">
            Welcome to Micronix
        </h3>

        <p class="mt-1 text-sm text-zinc-500">
            Sign in to manage your account, orders and wishlist.
        </p>

    </div>

    <a
        href="{{ route('login') }}"
        wire:navigate
        class="block rounded-xl bg-micronix-600 px-4 py-2.5 text-center text-sm font-medium text-white transition hover:bg-micronix-700"
    >
        Sign In
    </a>

    <a
        href="{{ route('register') }}"
        wire:navigate
        class="block rounded-xl border border-zinc-200 px-4 py-2.5 text-center text-sm font-medium transition hover:bg-zinc-50"
    >
        Create Account
    </a>

</div>