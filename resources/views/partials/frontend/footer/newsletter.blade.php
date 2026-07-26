{{-- resources/views/partials/frontend/footer/newsletter.blade.php --}}

<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">

        <div
            class="
                relative overflow-hidden rounded-lg
                bg-gradient-to-r
                from-micronix-700 via-micronix-600 to-micronix-500
            "
        >
            {{-- Decorative Glow --}}
            <div
                class="
                    pointer-events-none absolute
                    -left-10 top-1/2
                    size-40 -translate-y-1/2
                    rounded-full bg-white/10 blur-3xl
                "
            ></div>

            <div
                class="
                    pointer-events-none absolute
                    right-[18%] top-1/2
                    size-40 -translate-y-1/2
                    rounded-full bg-violet-300/20 blur-3xl
                "
            ></div>

            {{-- Content --}}
            <div
                class="
                    relative z-10
                    flex min-h-[92px]
                    flex-col gap-4
                    px-5 py-4
                    sm:px-7
                    lg:flex-row
                    lg:items-center
                    lg:px-8
                "
            >
                {{-- ================================================= --}}
                {{-- Left                                              --}}
                {{-- ================================================= --}}

                <div class="flex min-w-0 items-center gap-4 lg:w-[48%]">

                    {{-- Mail Icon --}}
                    <div
                        class="
                            flex size-12 shrink-0
                            items-center justify-center
                            rounded-lg
                            border border-white/20
                            bg-white/10
                            text-white
                            backdrop-blur-sm
                        "
                    >
                        <flux:icon.envelope class="size-6" />
                    </div>

                    {{-- Text --}}
                    <div class="min-w-0">
                        <h2
                            class="
                                text-base font-semibold
                                text-white
                                sm:text-lg
                            "
                        >
                            Stay Updated with Micronix
                        </h2>

                        <p
                            class="
                                mt-0.5
                                text-[11px] leading-4
                                text-white/75
                                sm:text-xs
                            "
                        >
                            Get the latest deals, new arrivals and tech updates
                            straight to your inbox.
                        </p>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- Newsletter Form                                   --}}
                {{-- ================================================= --}}

                <div
                    class="
                        relative z-20
                        min-w-0 flex-1
                        lg:ml-auto
                        lg:max-w-[500px]
                    "
                >
                    <form
                        action="#"
                        method="POST"
                        class="
                            flex overflow-hidden
                            rounded-lg bg-white
                            p-1
                            shadow-sm
                        "
                    >
                        @csrf

                        <label for="newsletter-email" class="sr-only">
                            Email address
                        </label>

                        <input
                            id="newsletter-email"
                            type="email"
                            name="email"
                            required
                            autocomplete="email"
                            placeholder="Enter your email address"
                            class="
                                h-10 min-w-0 flex-1
                                border-0 bg-transparent
                                px-3
                                text-xs text-zinc-900
                                outline-none
                                placeholder:text-zinc-400
                                focus:ring-0
                            "
                        >

                        <button
                            type="submit"
                            class="
                                inline-flex h-10 shrink-0
                                items-center justify-center
                                rounded-md
                                bg-micronix-600
                                px-5
                                text-xs font-semibold
                                text-white
                                transition
                                hover:bg-micronix-700
                                sm:px-7
                            "
                        >
                            Subscribe
                        </button>
                    </form>
                </div>

                {{-- ================================================= --}}
                {{-- Decorative Paper Plane                            --}}
                {{-- ================================================= --}}

                <div
                    class="
                        pointer-events-none
                        absolute -bottom-5 -right-3
                        hidden
                        rotate-[-12deg]
                        text-white/25
                        xl:block
                    "
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1"
                        class="size-24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.5 6h9.75m0 0v9.75m0-9.75L13.5 12.75M6.75 21l-3-3m0 0 3-3m-3 3h11.25"
                        />
                    </svg>
                </div>
            </div>
        </div>

    </div>
</section>