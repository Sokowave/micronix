<div class="border-b border-zinc-100 p-4">

    <div class="flex items-center gap-3">

        <div
            class="
                flex size-11 items-center justify-center
                rounded-full bg-micronix-100
                text-base font-semibold text-micronix-700
            "
        >
            {{ auth()->user()->initials() }}
        </div>

        <div class="min-w-0">

            <p class="truncate font-semibold text-zinc-900">
                {{ auth()->user()->name }}
            </p>

            <p class="truncate text-sm text-zinc-500">
                {{ auth()->user()->email }}
            </p>

        </div>

    </div>

</div>