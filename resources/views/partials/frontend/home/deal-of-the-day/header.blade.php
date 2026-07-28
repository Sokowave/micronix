{{-- resources/views/partials/frontend/home/deal-of-the-day/header.blade.php --}}

<div
    class="
        flex h-12 items-center justify-between
        bg-gradient-to-r
        from-micronix-600 to-micronix-400
        px-4 text-white
    "
>
    {{-- Title --}}
    <div class="min-w-0 flex items-center gap-1.5">
        <flux:icon.bolt class="size-5 shrink-0 fill-white" />

        <h2 class="truncate text-base font-semibold">
            {{ $deal->name }}
        </h2>
    </div>

    {{-- Countdown --}}
    <div
        class="ml-3 flex shrink-0 items-center gap-1.5"
        data-countdown
        data-countdown-ends-at="{{ $deal->ends_at->toIso8601String() }}"
    >
        <span
            class="
                rounded bg-micronix-700/50
                px-2 py-1
                text-[10px] font-semibold
            "
        >
            Ends in:
        </span>

        {{-- Hours --}}
        <div
            class="
                flex h-8 min-w-8 flex-col
                items-center justify-center
                rounded bg-white/20
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

        {{-- Minutes --}}
        <div
            class="
                flex h-8 min-w-8 flex-col
                items-center justify-center
                rounded bg-white/20
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

        {{-- Seconds --}}
        <div
            class="
                flex h-8 min-w-8 flex-col
                items-center justify-center
                rounded bg-white/20
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