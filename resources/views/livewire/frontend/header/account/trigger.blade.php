<button
    type="button"
    class="flex h-12 cursor-pointer items-center gap-2 rounded-xl px-3 transition hover:bg-zinc-50"
>
    <div
        class="
            flex size-9 items-center justify-center
            rounded-full
            @auth
                bg-micronix-100 text-micronix-700
            @else
                bg-zinc-100 text-zinc-500
            @endauth
        "
    >
        @auth
            <span class="text-sm font-semibold">
                {{ auth()->user()->initials() }}
            </span>
        @else
            <flux:icon.user class="size-4.5" />
        @endauth
    </div>

    <div class="hidden text-left xl:block">

        <span class="block text-[11px] leading-none text-zinc-400">
            @auth
                Welcome
            @else
                Sign in
            @endauth
        </span>

        <span class="mt-1 block max-w-24 truncate text-sm font-medium leading-none text-zinc-800">
            {{ auth()->user()?->name ?? 'Account' }}
        </span>

    </div>

    <flux:icon.chevron-down
        class="hidden size-4 text-zinc-400 transition group-hover:rotate-180 xl:block"
    />

</button>