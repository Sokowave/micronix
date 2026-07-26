{{-- resources/views/partials/frontend/home/brands.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        {{-- Header --}}
        <div class="mb-3 flex items-center justify-between gap-4">
            <h2 class="text-base font-semibold text-zinc-900">
                Top Brands You Can Trust
            </h2>

            <a
                href="#"
                wire:navigate
                class="
                    group inline-flex shrink-0 items-center gap-1
                    text-xs font-medium text-micronix-600
                    transition hover:text-micronix-700
                "
            >
                View All Brands

                <flux:icon.arrow-right
                    class="
                        size-3.5
                        transition-transform duration-200
                        group-hover:translate-x-0.5
                    "
                />
            </a>
        </div>

        {{-- Brands Carousel --}}
        <x-frontend.carousel
            type="default"
            :autoplay="false"
            :loop="false"
            :dots="false"
            :navigation="true"
        >

            {{-- HP --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop HP products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=HP"
                        alt="HP"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Dell --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Dell products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=DELL"
                        alt="Dell"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Lenovo --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Lenovo products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=Lenovo"
                        alt="Lenovo"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- ASUS --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop ASUS products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=ASUS"
                        alt="ASUS"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- MSI --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop MSI products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=MSI"
                        alt="MSI"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Canon --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Canon products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=Canon"
                        alt="Canon"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Logitech --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Logitech products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=logitech"
                        alt="Logitech"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Samsung --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Samsung products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=SAMSUNG"
                        alt="Samsung"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Intel --}}
            <div class="shrink-0 basis-[135px] pr-2">
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop Intel products"
                    class="
                        group flex h-16 w-full
                        items-center justify-center
                        rounded-lg border border-zinc-200
                        bg-white px-5
                        transition duration-200
                        hover:border-micronix-200
                        hover:shadow-sm
                    "
                >
                    <img
                        src="https://placehold.co/160x60/ffffff/111111?text=intel"
                        alt="Intel"
                        class="
                            max-h-8 max-w-[100px] object-contain
                            transition-transform duration-200
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

        </x-frontend.carousel>

    </div>
</section>