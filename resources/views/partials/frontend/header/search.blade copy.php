{{-- resources/views/partials/frontend/header/search.blade.php --}}

<form
    action="{{ route('search') }}"
    method="GET"
    role="search"
    class="mx-auto w-full max-w-3xl"
>
    <label for="header-search" class="sr-only">
        Search products
    </label>

    <div class="group relative">
        <flux:icon.magnifying-glass
            class="pointer-events-none absolute left-4 top-1/2 size-5 -translate-y-1/2 text-zinc-400 transition group-focus-within:text-micronix-500"
        />

        <input
            id="header-search"
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search laptops, phones, accessories and more..."
            autocomplete="off"
            class="h-12 w-full rounded-xl border border-zinc-300 bg-zinc-50 pl-12 pr-28 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 hover:border-zinc-400 focus:border-micronix-500 focus:bg-white focus:ring-4 focus:ring-micronix-500/10"
        >

        <button
            type="submit"
            class="absolute right-1.5 top-1/2 -translate-y-1/2 cursor-pointer rounded-lg bg-micronix-500 px-5 py-2 text-sm font-medium text-white transition hover:bg-micronix-600"
        >
            Search
        </button>
    </div>
</form>