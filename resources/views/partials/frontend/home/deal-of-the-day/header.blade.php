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
    <div class="flex items-center gap-1.5">
        <flux:icon.bolt class="size-5 fill-white" />

        <h2 class="text-base font-semibold">
            Deal of the Day
        </h2>
    </div>

    {{-- Countdown --}}
    <div class="flex items-center gap-1.5">
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
            <span class="text-xs font-bold leading-none">
                08
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
            <span class="text-xs font-bold leading-none">
                24
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
            <span class="text-xs font-bold leading-none">
                36
            </span>

            <span class="mt-0.5 text-[7px] leading-none text-white/70">
                Sec
            </span>
        </div>
    </div>
</div>