{{-- resources/views/partials/frontend/header/navbar.blade.php --}}

<div class="hidden lg:block">
    <div class="mx-auto flex h-20 max-w-7xl items-center gap-8 px-4 xl:px-6">

        <a
            href="{{ route('home') }}"
            wire:navigate
            class="shrink-0"
            aria-label="Micronix home"
        >
            <span class="text-2xl font-bold tracking-tight text-zinc-950">
                Micro<span class="text-micronix-500">nix</span>
            </span>
        </a>

        <div class="min-w-0 flex-1">
            @include('partials.frontend.header.search')
        </div>

        @include('partials.frontend.header.actions')
    </div>
</div>