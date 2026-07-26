{{-- resources/views/partials/frontend/footer/bottom.blade.php --}}

<div class="border-t border-zinc-200 py-6">
    <div class="flex flex-col gap-4 text-xs text-zinc-500 sm:flex-row sm:items-center sm:justify-between">
        <p>
            &copy; {{ now()->year }} Micronix. All rights reserved.
        </p>

        <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
            <a
                href="#"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Privacy Policy
            </a>

            <a
                href="#"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Terms & Conditions
            </a>

            <a
                href="#"
                wire:navigate
                class="transition hover:text-micronix-600"
            >
                Cookie Policy
            </a>
        </div>
    </div>
</div>