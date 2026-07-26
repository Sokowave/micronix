{{-- resources/views/layouts/frontend.blade.php --}}

<x-layouts::frontend.app :title="$title ?? null">
    <main class="flex-1">
        {{ $slot }}
    </main>
</x-layouts::frontend.app>