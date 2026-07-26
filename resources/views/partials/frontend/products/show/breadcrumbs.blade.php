{{-- resources/views/partials/frontend/products/show/breadcrumbs.blade.php --}}

<nav
    aria-label="Breadcrumb"
    class="border-b border-zinc-100 bg-white"
>
    <div class="mx-auto max-w-7xl px-2 xl:px-6">
        <ol
            class="
                flex h-11 items-center gap-1.5
                overflow-x-auto whitespace-nowrap
                text-xs text-zinc-500
                [scrollbar-width:none]
                [&::-webkit-scrollbar]:hidden
            "
        >
            {{-- Home --}}
            <li class="shrink-0">
                <a
                    href="{{ route('home') }}"
                    wire:navigate
                    class="inline-flex items-center gap-1.5 transition hover:text-micronix-600"
                >
                    <flux:icon.home class="size-3.5" />

                    <span class="hidden sm:inline">
                        Home
                    </span>
                </a>
            </li>

            {{-- Categories --}}
            @foreach ($breadcrumbs as $category)
                <li class="flex shrink-0 items-center" aria-hidden="true">
                    <flux:icon.chevron-right class="size-3.5 text-zinc-300" />
                </li>

                <li class="shrink-0">
                    <a
                        href="{{ route('categories.show', $category) }}"
                        wire:navigate
                        class="transition hover:text-micronix-600"
                    >
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach

            {{-- Product --}}
            <li class="flex shrink-0 items-center" aria-hidden="true">
                <flux:icon.chevron-right class="size-3.5 text-zinc-300" />
            </li>

            <li
                class="
                    max-w-[220px] truncate
                    font-medium text-zinc-800
                    sm:max-w-sm
                    lg:max-w-lg
                "
                aria-current="page"
                title="{{ $product->name }}"
            >
                {{ $product->name }}
            </li>
        </ol>
    </div>
</nav>