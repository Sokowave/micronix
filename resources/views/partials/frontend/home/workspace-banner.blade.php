{{-- resources/views/partials/frontend/home/workspace-banner.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <div
            class="
                relative overflow-hidden rounded-lg
                bg-gradient-to-r
                from-micronix-700
                via-micronix-600
                to-micronix-500
            "
        >
            {{-- Decorative glow --}}
            <div
                class="
                    pointer-events-none
                    absolute left-[38%] top-1/2
                    size-56 -translate-y-1/2
                    rounded-full bg-white/10 blur-3xl
                "
            ></div>

            <div
                class="
                    relative flex h-[130px]
                    items-center px-5
                    sm:px-7
                    lg:px-9
                "
            >
                {{-- ================================================= --}}
                {{-- Left: Content                                     --}}
                {{-- ================================================= --}}

                <div
                    class="
                        relative z-20
                        w-[65%]
                        sm:w-[38%]
                        lg:w-[31%]
                    "
                >
                    <h2
                        class="
                            text-xl font-bold
                            tracking-tight text-white
                            sm:text-2xl
                        "
                    >
                        Upgrade Your Workspace
                    </h2>

                    <p
                        class="
                            mt-1.5 max-w-[260px]
                            text-[11px] leading-[1.55]
                            text-white/85
                            sm:text-xs
                        "
                    >
                        Powerful devices. Seamless performance.<br class="hidden sm:block">
                        Everything you need to do more.
                    </p>
                </div>

                {{-- ================================================= --}}
                {{-- Centre: Workspace Setup                           --}}
                {{-- ================================================= --}}

                <div
                    class="
                        pointer-events-none
                        absolute inset-y-0
                        left-[29%] right-[18%]
                        z-10
                        hidden
                        items-end justify-center
                        sm:flex
                    "
                >
                    <img
                        src="https://placehold.co/900x260/transparent/ffffff?text=Workspace+Setup"
                        alt=""
                        class="
                            h-full w-full
                            object-contain object-bottom
                        "
                    >
                </div>

                {{-- ================================================= --}}
                {{-- Right: CTA                                        --}}
                {{-- ================================================= --}}

                <div
                    class="
                        relative z-20
                        ml-auto hidden shrink-0
                        sm:block
                    "
                >
                    <a
                        href="#"
                        wire:navigate
                        class="
                            group inline-flex
                            min-w-[145px]
                            items-center justify-center
                            gap-2
                            rounded-lg bg-white
                            px-5 py-3
                            text-xs font-semibold
                            text-micronix-600
                            shadow-sm
                            transition
                            hover:bg-micronix-50
                        "
                    >
                        Shop Now

                        <flux:icon.arrow-right
                            class="
                                size-3.5
                                transition-transform duration-200
                                group-hover:translate-x-0.5
                            "
                        />
                    </a>
                </div>

                {{-- Mobile CTA --}}
                <a
                    href="#"
                    wire:navigate
                    aria-label="Shop workspace products"
                    class="
                        absolute bottom-3 right-3 z-20
                        flex size-9
                        items-center justify-center
                        rounded-full bg-white
                        text-micronix-600
                        shadow-sm
                        sm:hidden
                    "
                >
                    <flux:icon.arrow-right class="size-4" />
                </a>
            </div>
        </div>

    </div>
</section>