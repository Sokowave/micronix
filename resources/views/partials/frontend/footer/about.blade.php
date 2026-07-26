{{-- resources/views/partials/frontend/footer/about.blade.php --}}

<div class="sm:col-span-2 lg:col-span-2">
    <a
        href="{{ route('home') }}"
        wire:navigate
        class="inline-flex items-center text-xl font-bold tracking-tight text-zinc-900"
    >
        Micronix
    </a>

    <p class="mt-4 max-w-md text-sm leading-6 text-zinc-500">
        Shop computers, phones, cameras, electronics and accessories from trusted brands.
    </p>

    <div class="mt-6 space-y-4 text-sm">
        <div class="flex items-center gap-3">
            <flux:icon.envelope class="size-5 shrink-0 text-micronix-500" />

            <a
                href="#"
                class="text-zinc-600 transition hover:text-micronix-600"
            >
                Email us
            </a>
        </div>

        <div class="flex items-center gap-3">
            <flux:icon.phone class="size-5 shrink-0 text-micronix-500" />

            <a
                href="#"
                class="text-zinc-600 transition hover:text-micronix-600"
            >
                Contact us
            </a>
        </div>

        <div class="flex items-center gap-3">
            <flux:icon.map-pin class="size-5 shrink-0 text-micronix-500" />

            <span class="text-zinc-600">
                Nairobi, Kenya
            </span>
        </div>
    </div>
</div>