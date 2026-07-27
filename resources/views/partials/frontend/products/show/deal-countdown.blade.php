{{-- Deal Countdown --}}
@if ($deal)
    <div
        data-countdown
        data-countdown-ends-at="{{ $deal->ends_at->toIso8601String() }}"
        class="
            mt-3 flex items-center justify-between gap-3
            rounded-lg border border-micronix-100
            bg-micronix-50 px-3 py-2
        "
    >
        {{-- Label --}}
        <div class="flex min-w-0 items-center gap-2">
            <div
                class="
                    flex size-8 shrink-0
                    items-center justify-center
                    rounded-full bg-micronix-100
                    text-micronix-600
                "
            >
                <flux:icon.bolt class="size-4 fill-current" />
            </div>

            <div class="min-w-0">
                <p class="text-xs font-semibold text-micronix-700">
                    {{ $deal->name }}
                </p>

                <p class="text-[10px] text-zinc-500">
                    Deal ends in
                </p>
            </div>
        </div>

        {{-- Countdown --}}
        <div class="flex shrink-0 items-center gap-1">

            {{-- Hours --}}
            <div
                class="
                    flex h-9 min-w-9 flex-col
                    items-center justify-center
                    rounded-md bg-micronix-600
                    px-1 text-white
                "
            >
                <span
                    data-countdown-hours
                    class="text-xs font-bold leading-none"
                >
                    00
                </span>

                <span class="mt-0.5 text-[7px] leading-none text-white/70">
                    Hrs
                </span>
            </div>

            <span class="text-xs font-bold text-micronix-400">
                :
            </span>

            {{-- Minutes --}}
            <div
                class="
                    flex h-9 min-w-9 flex-col
                    items-center justify-center
                    rounded-md bg-micronix-600
                    px-1 text-white
                "
            >
                <span
                    data-countdown-minutes
                    class="text-xs font-bold leading-none"
                >
                    00
                </span>

                <span class="mt-0.5 text-[7px] leading-none text-white/70">
                    Min
                </span>
            </div>

            <span class="text-xs font-bold text-micronix-400">
                :
            </span>

            {{-- Seconds --}}
            <div
                class="
                    flex h-9 min-w-9 flex-col
                    items-center justify-center
                    rounded-md bg-micronix-600
                    px-1 text-white
                "
            >
                <span
                    data-countdown-seconds
                    class="text-xs font-bold leading-none"
                >
                    00
                </span>

                <span class="mt-0.5 text-[7px] leading-none text-white/70">
                    Sec
                </span>
            </div>
        </div>
    </div>
@endif