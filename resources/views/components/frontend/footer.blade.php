{{-- resources/views/components/frontend/footer.blade.php --}}

<footer class="border-t border-zinc-200 bg-white text-zinc-600">
    @include('partials.frontend.footer.newsletter')

    <div class="mx-auto max-w-7xl px-2 xl:px-6">
        <div class="grid gap-10 py-12 sm:grid-cols-2 lg:grid-cols-5 lg:gap-8 lg:py-14">
            @include('partials.frontend.footer.about')
            @include('partials.frontend.footer.links')
        </div>

        @include('partials.frontend.footer.social')
        @include('partials.frontend.footer.bottom')
    </div>
</footer>