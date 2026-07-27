{{-- resources/views/partials/frontend/home/promo-banners.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <x-frontend.carousel
            type="default"
            :autoplay="false"
            :loop="false"
            :dots="false"
            :navigation="true"
        >
            {{-- Build Your Dream Setup --}}
            <div class="min-w-0 shrink-0 basis-[450px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group relative block min-h-[225px]
                        overflow-hidden rounded-xl bg-violet-50
                    "
                >
                    <div class="relative z-10 w-[58%] p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-micronix-600">
                            Upgrade Your Setup
                        </span>

                        <h3 class="mt-2 text-base font-bold leading-tight text-zinc-900 xl:text-lg">
                            Build Your
                            <br>
                            Dream Setup
                        </h3>

                        <p class="mt-2 text-sm leading-5 text-zinc-500">
                            Everything you need for the perfect workspace.
                        </p>

                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-micronix-600">
                            Shop Now

                            <flux:icon.arrow-right
                                class="size-4 transition-transform duration-200 group-hover:translate-x-1"
                            />
                        </span>
                    </div>

                    <img
                        src="https://placehold.co/400x400"
                        alt="Computer setup"
                        class="
                            absolute -bottom-8 -right-8 rotate-30
                            h-[82%] w-[48%]
                            object-contain object-bottom
                            transition-transform duration-500
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Work Smart Anywhere --}}
            <div class="min-w-0 shrink-0 basis-[450px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group relative block min-h-[225px]
                        overflow-hidden rounded-xl bg-indigo-50
                    "
                >
                    <div class="relative z-10 w-[58%] p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-micronix-600">
                            Powerful Laptops
                        </span>

                        <h3 class="mt-2 text-xl font-bold leading-tight text-zinc-900 xl:text-2xl">
                            Work Smart.
                            <br>
                            Anywhere.
                        </h3>

                        <p class="mt-2 text-sm leading-5 text-zinc-500">
                            Performance that keeps up with your day.
                        </p>

                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-micronix-600">
                            Shop Laptops

                            <flux:icon.arrow-right
                                class="size-4 transition-transform duration-200 group-hover:translate-x-1"
                            />
                        </span>
                    </div>

                    <img
                        src="https://placehold.co/400x400"
                        alt="Laptop computer"
                        class="
                            absolute -bottom-8 -right-8 rotate-30
                            h-[82%] w-[50%]
                            object-contain object-bottom
                            transition-transform duration-500
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

            {{-- Capture Every Moment --}}
            <div class="min-w-0 shrink-0 basis-[450px] pr-3">
                <a
                    href="#"
                    wire:navigate
                    class="
                        group relative block min-h-[225px]
                        overflow-hidden rounded-xl bg-fuchsia-50
                    "
                >
                    <div class="relative z-10 w-[58%] p-6">
                        <span class="text-xs font-semibold uppercase tracking-wider text-micronix-600">
                            Cameras & Gear
                        </span>

                        <h3 class="mt-2 text-xl font-bold leading-tight text-zinc-900 xl:text-2xl">
                            Capture Every
                            <br>
                            Moment
                        </h3>

                        <p class="mt-2 text-sm leading-5 text-zinc-500">
                            Create incredible photos and videos.
                        </p>

                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-micronix-600">
                            Shop Cameras

                            <flux:icon.arrow-right
                                class="size-4 transition-transform duration-200 group-hover:translate-x-1"
                            />
                        </span>
                    </div>

                    <img
                        src="https://placehold.co/400x400"
                        alt="Digital camera"
                        class="
                            absolute -bottom-8 -right-8 rotate-30
                            h-[82%] w-[48%]
                            object-contain object-bottom
                            transition-transform duration-500
                            group-hover:scale-105
                        "
                    >
                </a>
            </div>

        </x-frontend.carousel>

    </div>
</section>