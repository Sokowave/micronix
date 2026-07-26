{{-- resources/views/partials/frontend/home/computer-components.blade.php --}}

<div class="min-w-0">

    {{-- Header --}}
    <div class="mb-3 flex items-center justify-between gap-4">
        <h2 class="text-base font-semibold text-zinc-900">
            Computer Components
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

        {{-- Intel Core i5 --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        flex aspect-square items-center justify-center
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
                        alt="Intel Core i5-12400F"
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
                        Intel Core i5-12400F
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 19,900
                    </p>
                </div>
            </a>
        </article>

        {{-- MSI Motherboard --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        flex aspect-square items-center justify-center
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
                        alt="MSI B660M Mortar Motherboard"
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
                        MSI B660M Mortar Motherboard
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 23,500
                    </p>
                </div>
            </a>
        </article>

        {{-- Corsair RAM --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        flex aspect-square items-center justify-center
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
                        alt="Corsair 16GB DDR4 3200MHz"
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
                        Corsair 16GB DDR4 3200MHz
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 5,500
                    </p>
                </div>
            </a>
        </article>

        {{-- Cooler Master PSU --}}
        <article class="group min-w-0">
            <a
                href="#"
                wire:navigate
                class="block"
            >
                <div
                    class="
                        flex aspect-square items-center justify-center
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
                        alt="Cooler Master 650W Power Supply"
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
                        Cooler Master 650W Power Supply
                    </h3>

                    <p class="mt-1 text-xs font-bold text-zinc-900">
                        KES 8,000
                    </p>
                </div>
            </a>
        </article>

    </div>
</div>