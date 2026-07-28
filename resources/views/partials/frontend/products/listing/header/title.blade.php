        
        
        <div>
            <h1
                class="
                    text-xl font-bold tracking-tight
                    text-zinc-950
                    sm:text-2xl
                "
            >
                {{ $category?->name ?? 'All Products' }}
            </h1>

            <p
                class="
                    mt-1.5 max-w-3xl
                    text-sm leading-6
                    text-zinc-500
                "
            >
                {{ $category?->description ?: 'Shop computers, components, accessories, networking, cameras and more from leading technology brands.' }}
            </p>
        </div>