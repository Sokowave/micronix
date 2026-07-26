{{-- resources/views/partials/frontend/products/show/specifications.blade.php --}}

<section
    id="product-specifications"
    class="scroll-mt-24"
>
    {{-- ========================================================= --}}
    {{-- Section Header                                            --}}
    {{-- ========================================================= --}}

    <div class="mb-5">
        <h2 class="text-xl font-bold tracking-tight text-zinc-950">
            Specifications
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Technical details and specifications for this product.
        </p>
    </div>

    {{-- ========================================================= --}}
    {{-- Specifications                                            --}}
    {{-- ========================================================= --}}

    <div
        class="
            overflow-hidden rounded-xl
            border border-zinc-200
            bg-white
        "
    >
        {{-- ===================================================== --}}
        {{-- General                                               --}}
        {{-- ===================================================== --}}

        <div>
            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.information-circle
                        class="size-4 text-micronix-600"
                    />

                    General
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Brand
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        HP
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Model
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        EliteBook 840 G8
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Condition
                    </dt>

                    <dd>
                        <span
                            class="
                                inline-flex items-center gap-1.5
                                rounded-full
                                bg-emerald-50
                                px-2 py-1
                                text-[11px] font-semibold
                                text-emerald-700
                            "
                        >
                            <span
                                class="
                                    size-1.5 rounded-full
                                    bg-emerald-500
                                "
                            ></span>

                            New
                        </span>
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Colour
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Silver
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Performance                                           --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.cpu-chip
                        class="size-4 text-micronix-600"
                    />

                    Performance
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Processor
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Intel Core i7-1165G7
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Processor Generation
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        11th Generation
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Memory (RAM)
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        16GB DDR4
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Graphics
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Intel Iris Xe Graphics
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Storage                                               --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.circle-stack
                        class="size-4 text-micronix-600"
                    />

                    Storage
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Storage Capacity
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        512GB
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Storage Type
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        NVMe SSD
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Display                                               --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.computer-desktop
                        class="size-4 text-micronix-600"
                    />

                    Display
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Screen Size
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        14 inches
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Resolution
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        1920 × 1080 Full HD
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Display Type
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        IPS Anti-glare
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Connectivity                                          --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.wifi
                        class="size-4 text-micronix-600"
                    />

                    Connectivity
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Wireless
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Wi-Fi 6, Bluetooth 5.0
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Ports
                    </dt>

                    <dd class="text-sm leading-6 text-zinc-800">
                        2 × Thunderbolt 4, 2 × USB-A 3.1,
                        HDMI 2.0, 3.5mm Audio
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Software                                              --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.window
                        class="size-4 text-micronix-600"
                    />

                    Software
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Operating System
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Windows 11 Pro
                    </dd>
                </div>

            </dl>
        </div>

        {{-- ===================================================== --}}
        {{-- Warranty                                              --}}
        {{-- ===================================================== --}}

        <div class="border-t border-zinc-200">

            <div
                class="
                    border-b border-zinc-200
                    bg-zinc-50
                    px-4 py-3
                    sm:px-5
                "
            >
                <h3
                    class="
                        flex items-center gap-2
                        text-sm font-semibold
                        text-zinc-900
                    "
                >
                    <flux:icon.shield-check
                        class="size-4 text-micronix-600"
                    />

                    Warranty
                </h3>
            </div>

            <dl class="divide-y divide-zinc-100">

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Warranty Period
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        12 Months
                    </dd>
                </div>

                <div
                    class="
                        grid gap-1
                        px-4 py-3
                        sm:grid-cols-[220px_1fr]
                        sm:gap-6
                        sm:px-5
                    "
                >
                    <dt class="text-xs font-medium text-zinc-500">
                        Warranty Type
                    </dt>

                    <dd class="text-sm text-zinc-800">
                        Seller Warranty
                    </dd>
                </div>

            </dl>
        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- Disclaimer                                                --}}
    {{-- ========================================================= --}}

    <p class="mt-3 text-[10px] leading-4 text-zinc-400">
        Product specifications may vary depending on configuration.
        Please confirm specific requirements before placing your order.
    </p>

</section>