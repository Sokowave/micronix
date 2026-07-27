{{-- resources/views/livewire/frontend/home.blade.php --}}

<div>
    @include('partials.frontend.home.hero')

    @include('partials.frontend.home.categories')

    @include('partials.frontend.home.benefits')

    @include('partials.frontend.home.featured-products')

    @include('partials.frontend.home.promo-banners')

    @include('partials.frontend.home.deal-of-the-day')

    {{-- Category Product Sections --}}
    @if ($categorySections->isNotEmpty())
        @foreach ($categorySections->chunk(2) as $groupIndex => $group)
            {{-- Category pair --}}
            <section class="py-4">
                <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">
                    <div class="grid gap-6 lg:grid-cols-2">
                        @foreach ($group as $section)
                            @include('partials.frontend.home.category-products', [
                                'category' => $section['category'],
                                'products' => $section['products'],
                            ])
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Banner after category pair --}}
            @if ($banner = $categoryBanners->get($groupIndex))
                <section class="py-4">
                    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">
                        @include('partials.frontend.home.category-banner', [
                            'banner' => $banner,
                        ])
                    </div>
                </section>
            @else
            {{-- Banner after every two categories --}}
<section class="py-4">
    <div class="mx-auto w-full max-w-7xl px-4 xl:px-6">
        @include('partials.frontend.home.category-banner', [
            'banner' => $categoryBanners->get($groupIndex),
        ])
    </div>
</section>
            @endif
        @endforeach
    @endif

    @include('partials.frontend.home.use-cases')

    @include('partials.frontend.home.new-arrivals')

    @include('partials.frontend.home.workspace-banner')

    @include('partials.frontend.home.brands')

    @include('partials.frontend.home.why-micronix')
</div>