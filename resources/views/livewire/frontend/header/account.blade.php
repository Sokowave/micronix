<div class="group relative">

    @include('livewire.frontend.header.account.trigger')

    <div
        class="
            invisible absolute right-0 top-full z-50 mt-2
            w-72 rounded-2xl border border-zinc-200 bg-white
            p-2 opacity-0 shadow-xl
            transition-all duration-200
            group-hover:visible
            group-hover:opacity-100
        "
    >
        @auth

            @include('livewire.frontend.header.account.profile')

            @include('livewire.frontend.header.account.menu')

        @else

            @include('livewire.frontend.header.account.guest')

        @endauth

    </div>

</div>