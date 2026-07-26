{{-- resources/views/partials/frontend/products/listing/breadcrumb.blade.php --}}

<nav
    aria-label="Breadcrumb"
    class="mb-3"
>
    <ol class="flex flex-wrap items-center gap-1.5 text-xs text-zinc-500">

        <li>
            <a
                href="{{ route('home') }}"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Home
            </a>
        </li>

        <li class="flex items-center" aria-hidden="true">
            <flux:icon.chevron-right class="size-3.5 text-zinc-300" />
        </li>

        @if ($category)

            @foreach ($breadcrumbs as $breadcrumb)

                @if (! $loop->last)
                    <li>
                        <a
                            href="{{ route('categories.show', $breadcrumb) }}"
                            wire:navigate
                            class="transition hover:text-micronix-600"
                        >
                            {{ $breadcrumb->name }}
                        </a>
                    </li>

                    <li class="flex items-center" aria-hidden="true">
                        <flux:icon.chevron-right class="size-3.5 text-zinc-300" />
                    </li>
                @else
                    <li
                        class="font-medium text-zinc-700"
                        aria-current="page"
                    >
                        {{ $breadcrumb->name }}
                    </li>
                @endif

            @endforeach

        @else
            <li
                class="font-medium text-zinc-700"
                aria-current="page"
            >
                Products
            </li>
        @endif

    </ol>
</nav>