{{-- resources/views/partials/frontend/home/laptops-computers.blade.php --}}

<div class="min-w-0">

    {{-- Header --}}
    <div class="mb-3 flex items-center justify-between gap-4">
        <h2 class="text-base font-semibold text-zinc-900">
            Laptops & Computers
        </h2>

        <a
            href="#"
            wire:navigate
            class="group inline-flex shrink-0 items-center gap-1 text-xs font-medium text-micronix-600 transition hover:text-micronix-700"
        >
            View All

            <flux:icon.arrow-right
                class="size-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
            />
        </a>
    </div>

    {{-- Products --}}
    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">

        {{-- HP Pavilion 15 --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        relative flex aspect-square
                        items-center justify-center
                        overflow-hidden rounded-lg
                        border border-zinc-200
                        bg-white p-3
                        transition
                        group-hover:border-micronix-200
                        group-hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/400x400"
                        alt="HP Pavilion 15"
                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <div class="pt-2">
                    <h3
                        class="
                            line-clamp-1
                            text-[11px] font-medium
                            text-zinc-600
                            transition
                            group-hover:text-micronix-600
                        "
                    >
                        HP Pavilion 15
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 70,000
                    </p>
                </div>
            </a>
        </article>

        {{-- Lenovo IdeaPad 3 --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        relative flex aspect-square
                        items-center justify-center
                        overflow-hidden rounded-lg
                        border border-zinc-200
                        bg-white p-3
                        transition
                        group-hover:border-micronix-200
                        group-hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/400x400"
                        alt="Lenovo IdeaPad 3"
                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <div class="pt-2">
                    <h3
                        class="
                            line-clamp-1
                            text-[11px] font-medium
                            text-zinc-600
                            transition
                            group-hover:text-micronix-600
                        "
                    >
                        Lenovo IdeaPad 3
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 65,000
                    </p>
                </div>
            </a>
        </article>

        {{-- Acer Aspire 5 --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        relative flex aspect-square
                        items-center justify-center
                        overflow-hidden rounded-lg
                        border border-zinc-200
                        bg-white p-3
                        transition
                        group-hover:border-micronix-200
                        group-hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/400x400"
                        alt="Acer Aspire 5"
                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <div class="pt-2">
                    <h3
                        class="
                            line-clamp-1
                            text-[11px] font-medium
                            text-zinc-600
                            transition
                            group-hover:text-micronix-600
                        "
                    >
                        Acer Aspire 5
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 64,000
                    </p>
                </div>
            </a>
        </article>

        {{-- MacBook Air M2 --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        relative flex aspect-square
                        items-center justify-center
                        overflow-hidden rounded-lg
                        border border-zinc-200
                        bg-white p-3
                        transition
                        group-hover:border-micronix-200
                        group-hover:shadow-sm
                    "
                >
                    <span
                        class="
                            absolute left-2 top-2 z-10
                            rounded bg-micronix-600
                            px-1.5 py-0.5
                            text-[8px] font-bold uppercase
                            text-white
                        "
                    >
                        New
                    </span>

                    <img
                        src="https://placehold.co/400x400"
                        alt="MacBook Air M2"
                        class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    >
                </div>

                <div class="pt-2">
                    <h3
                        class="
                            line-clamp-1
                            text-[11px] font-medium
                            text-zinc-600
                            transition
                            group-hover:text-micronix-600
                        "
                    >
                        MacBook Air M2
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 155,000
                    </p>
                </div>
            </a>
        </article>

    </div>
</div>