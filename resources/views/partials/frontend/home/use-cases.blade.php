{{-- resources/views/partials/frontend/home/use-cases.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        {{-- Header --}}
        <div class="mb-3 flex items-center justify-between gap-4">
            <h2 class="text-base font-semibold text-zinc-900">
                Shop by Use Case
            </h2>

            <a
                href="#"
                wire:navigate
                class="group inline-flex shrink-0 items-center gap-1 text-xs font-medium text-micronix-600 transition hover:text-micronix-700"
            >
                View All Use Cases

                <flux:icon.arrow-right
                    class="size-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                />
            </a>
        </div>

        {{-- Carousel --}}
        <x-frontend.carousel
            type="default"
            :autoplay="false"
            :loop="false"
            :dots="false"
            :navigation="true"
        >

            {{-- Gaming Setup --}}
            <div class="shrink-0 basis-[260px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group flex min-h-24
                        items-center gap-3 overflow-hidden
                        rounded-xl border border-zinc-200
                        bg-gradient-to-br from-violet-50 to-white
                        px-4 py-3
                        transition duration-200
                        hover:border-micronix-200 hover:shadow-sm
                    "
                >
                    <div class="flex size-16 shrink-0 items-center justify-center">
                        <img
                            src="https://placehold.co/160x160"
                            alt="Gaming setup"
                            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
                            Gaming Setup
                        </h3>

                        <p class="mt-1 text-[11px] leading-4 text-zinc-500">
                            Build the ultimate gaming rig
                        </p>
                    </div>
                </a>
            </div>

            {{-- Office Setup --}}
            <div class="shrink-0 basis-[260px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group flex min-h-24
                        items-center gap-3 overflow-hidden
                        rounded-xl border border-zinc-200
                        bg-gradient-to-br from-sky-50 to-white
                        px-4 py-3
                        transition duration-200
                        hover:border-micronix-200 hover:shadow-sm
                    "
                >
                    <div class="flex size-16 shrink-0 items-center justify-center">
                        <img
                            src="https://placehold.co/160x160"
                            alt="Office setup"
                            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
                            Office Setup
                        </h3>

                        <p class="mt-1 text-[11px] leading-4 text-zinc-500">
                            Boost productivity at work
                        </p>
                    </div>
                </a>
            </div>

            {{-- Student Essentials --}}
            <div class="shrink-0 basis-[260px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group flex min-h-24
                        items-center gap-3 overflow-hidden
                        rounded-xl border border-zinc-200
                        bg-gradient-to-br from-amber-50 to-white
                        px-4 py-3
                        transition duration-200
                        hover:border-micronix-200 hover:shadow-sm
                    "
                >
                    <div class="flex size-16 shrink-0 items-center justify-center">
                        <img
                            src="https://placehold.co/160x160"
                            alt="Student essentials"
                            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
                            Student Essentials
                        </h3>

                        <p class="mt-1 text-[11px] leading-4 text-zinc-500">
                            Everything for study & projects
                        </p>
                    </div>
                </a>
            </div>

            {{-- Content Creation --}}
            <div class="shrink-0 basis-[260px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group flex min-h-24
                        items-center gap-3 overflow-hidden
                        rounded-xl border border-zinc-200
                        bg-gradient-to-br from-rose-50 to-white
                        px-4 py-3
                        transition duration-200
                        hover:border-micronix-200 hover:shadow-sm
                    "
                >
                    <div class="flex size-16 shrink-0 items-center justify-center">
                        <img
                            src="https://placehold.co/160x160"
                            alt="Content creation equipment"
                            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
                            Content Creation
                        </h3>

                        <p class="mt-1 text-[11px] leading-4 text-zinc-500">
                            Gear for creators & streamers
                        </p>
                    </div>
                </a>
            </div>

            {{-- Networking Solutions --}}
            <div class="shrink-0 basis-[260px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group flex min-h-24
                        items-center gap-3 overflow-hidden
                        rounded-xl border border-zinc-200
                        bg-gradient-to-br from-emerald-50 to-white
                        px-4 py-3
                        transition duration-200
                        hover:border-micronix-200 hover:shadow-sm
                    "
                >
                    <div class="flex size-16 shrink-0 items-center justify-center">
                        <img
                            src="https://placehold.co/160x160"
                            alt="Networking solutions"
                            class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-zinc-900 transition group-hover:text-micronix-600">
                            Networking Solutions
                        </h3>

                        <p class="mt-1 text-[11px] leading-4 text-zinc-500">
                            Stay connected always
                        </p>
                    </div>
                </a>
            </div>

        </x-frontend.carousel>

    </div>
</section>