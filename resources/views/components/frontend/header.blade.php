{{-- resources/views/components/frontend/header.blade.php --}}

<div class="relative z-50">
    {{-- Scrolls away --}}
    @include('partials.frontend.header.topbar')
</div>

<header class="sticky top-0 z-50 bg-white shadow-sm">
    <div class="border-b border-zinc-200">
        @include('partials.frontend.header.navbar')
        @include('partials.frontend.header.mobile')
    </div>

    @include('partials.frontend.header.categories')
</header>